<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

/**
 * Keranjang belanja sederhana yang disimpan di session.
 *
 * Struktur session: cart => [ product_id => qty ]
 * Struktur pilihan:  cart_selected => [ product_id, ... ]
 */
class Cart
{
    public const SESSION_KEY = 'cart';

    public const SELECTED_KEY = 'cart_selected';

    /** Ongkos kirim flat untuk seluruh wilayah. */
    public const SHIPPING_COST = 20000;

    /** Pembelian di atas nominal ini gratis ongkir. */
    public const FREE_SHIPPING_MINIMUM = 250000;

    /**
     * Isi keranjang mentah: [product_id => qty].
     *
     * @return array<int, int>
     */
    public function raw(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    public function add(Product $product, int $qty = 1): void
    {
        $items = $this->raw();
        $items[$product->id] = max(1, ($items[$product->id] ?? 0) + $qty);

        Session::put(self::SESSION_KEY, $items);
    }

    public function setQty(int $productId, int $qty): void
    {
        $items = $this->raw();

        if ($qty < 1) {
            unset($items[$productId]);
        } else {
            $items[$productId] = $qty;
        }

        Session::put(self::SESSION_KEY, $items);

        // Produk yang dihapus juga hilang dari pilihan.
        if (! isset($items[$productId])) {
            Session::put(self::SELECTED_KEY, array_values(array_diff($this->selectedIds(), [$productId])));
        }
    }

    public function remove(int $productId): void
    {
        $items = $this->raw();
        unset($items[$productId]);

        Session::put(self::SESSION_KEY, $items);
        Session::put(self::SELECTED_KEY, array_values(array_diff($this->selectedIds(), [$productId])));
    }

    public function clear(): void
    {
        Session::forget([self::SESSION_KEY, self::SELECTED_KEY]);
    }

    /**
     * Produk lengkap yang ada di keranjang.
     *
     * @return Collection<int, array{product: Product, qty: int, subtotal: int}>
     */
    public function items(): Collection
    {
        $items = $this->raw();

        if ($items === []) {
            return collect();
        }

        $products = Product::query()
            ->whereIn('id', array_keys($items))
            ->get()
            ->keyBy('id');

        return collect($items)
            ->map(function (int $qty, int $productId) use ($products) {
                $product = $products->get($productId);

                if (! $product) {
                    return null;
                }

                return [
                    'product' => $product,
                    'qty' => $qty,
                    'subtotal' => $product->price * $qty,
                ];
            })
            ->filter()
            ->values();
    }

    /**
     * @return array<int, int>
     */
    public function selectedIds(): array
    {
        return array_map('intval', Session::get(self::SELECTED_KEY, []));
    }

    public function selectAll(): void
    {
        Session::put(self::SELECTED_KEY, array_keys($this->raw()));
    }

    public function select(array $productIds): void
    {
        $available = array_keys($this->raw());

        Session::put(self::SELECTED_KEY, array_values(array_filter(
            array_map('intval', $productIds),
            fn (int $id) => in_array($id, $available, true)
        )));
    }

    public function isSelected(int $productId): bool
    {
        if (! Session::has(self::SELECTED_KEY)) {
            return true; // default: semua item terpilih
        }

        return in_array($productId, $this->selectedIds(), true);
    }

    /**
     * Item keranjang yang dicentang pada halaman keranjang.
     *
     * @return Collection<int, array{product: Product, qty: int, subtotal: int}>
     */
    public function selectedItems(): Collection
    {
        return $this->items()
            ->filter(fn (array $item) => $this->isSelected($item['product']->id))
            ->values();
    }

    public function count(): int
    {
        return (int) array_sum($this->raw());
    }

    public function isEmpty(): bool
    {
        return $this->raw() === [];
    }

    public static function shippingCost(int $subtotal): int
    {
        if ($subtotal <= 0) {
            return 0;
        }

        return $subtotal >= self::FREE_SHIPPING_MINIMUM ? 0 : self::SHIPPING_COST;
    }

    /**
     * @param  Collection<int, array{product: Product, qty: int, subtotal: int}>  $items
     * @return array{subtotal: int, shipping: int, total: int, free_shipping: bool}
     */
    public function summary(Collection $items): array
    {
        $subtotal = (int) $items->sum('subtotal');
        $shipping = self::shippingCost($subtotal);

        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
            'free_shipping' => $shipping === 0 && $subtotal > 0,
        ];
    }
}
