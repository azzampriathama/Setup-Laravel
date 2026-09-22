<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): View
    {
        $items = cart()->items();

        return view('cart.index', [
            'items' => $items,
            'summary' => cart()->summary($items),
            'allSelected' => $items->isNotEmpty()
                && $items->every(fn (array $item) => cart()->isSelected($item['product']->id)),
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $qty = max(1, (int) $request->input('qty', 1));

        cart()->add($product, $qty);

        return back()->with('success', "{$product->name} masuk ke keranjang belanja.");
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'qty' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        cart()->setQty((int) $validated['product_id'], (int) $validated['qty']);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        cart()->remove((int) $validated['product_id']);

        return back()->with('success', 'Produk dihapus dari keranjang belanja.');
    }

    /**
     * Simpan item yang dicentang lalu lanjut ke halaman metode pembayaran.
     */
    public function checkout(Request $request): RedirectResponse
    {
        $selected = array_map('intval', (array) $request->input('selected', []));

        if ($selected === []) {
            return back()->with('error', 'Pilih minimal satu produk untuk di-check out.');
        }

        cart()->select($selected);

        return redirect()->route('checkout.index');
    }

    public function clear(): RedirectResponse
    {
        cart()->clear();

        return back()->with('success', 'Keranjang belanja dikosongkan.');
    }

    /**
     * Info ongkos kirim untuk tooltip di halaman keranjang & pembayaran.
     */
    public static function shippingInfo(): string
    {
        return 'Ongkos kirim flat '.rupiah(Cart::SHIPPING_COST).' ke seluruh Indonesia, gratis untuk pembelian mulai '.rupiah(Cart::FREE_SHIPPING_MINIMUM).'.';
    }
}
