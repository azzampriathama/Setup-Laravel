<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Pilihan metode pembayaran sesuai prototipe.
     *
     * @var array<string, array{label: string, description: string, icon: string}>
     */
    public const PAYMENT_METHODS = [
        'transfer' => [
            'label' => 'Transfer Bank',
            'description' => 'BCA, BNI, BRI, Mandiri',
            'icon' => 'bank',
        ],
        'ewallet' => [
            'label' => 'E-Wallet',
            'description' => 'DANA, OVO, GoPay, ShopeePay',
            'icon' => 'wallet',
        ],
        'cod' => [
            'label' => 'COD (Bayar di tempat)',
            'description' => 'Tersedia untuk area tertentu',
            'icon' => 'cash',
        ],
    ];

    public function index(): View|RedirectResponse
    {
        $items = cart()->selectedItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Pilih produk yang ingin dibayar terlebih dahulu.');
        }

        return view('checkout.index', [
            'items' => $items,
            'summary' => cart()->summary($items),
            'methods' => self::PAYMENT_METHODS,
            'selectedMethod' => old('payment_method', array_key_first(self::PAYMENT_METHODS)),
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $items = cart()->selectedItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kamu kosong.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:25'],
            'customer_address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'in:'.implode(',', array_keys(self::PAYMENT_METHODS))],
        ], attributes: [
            'customer_name' => 'nama penerima',
            'customer_phone' => 'nomor HP',
            'customer_address' => 'alamat lengkap',
            'payment_method' => 'metode pembayaran',
        ]);

        $summary = cart()->summary($items);
        $method = self::PAYMENT_METHODS[$validated['payment_method']];

        $order = DB::transaction(function () use ($validated, $items, $summary, $method) {
            $order = Order::create([
                'invoice_number' => 'BL-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_address' => $validated['customer_address'],
                'payment_method' => $validated['payment_method'],
                'payment_label' => $method['label'],
                'subtotal' => $summary['subtotal'],
                'shipping_cost' => $summary['shipping'],
                'total' => $summary['total'],
                'status' => 'Menunggu Pembayaran',
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'qty' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            return $order;
        });

        cart()->clear();

        return redirect()->route('checkout.success', $order->invoice_number)
            ->with('success', 'Pesanan berhasil dibuat. Terima kasih sudah belanja di Belia Cosmetic!');
    }

    public function success(string $invoice): View
    {
        $order = Order::with('items')->where('invoice_number', $invoice)->firstOrFail();

        return view('checkout.success', [
            'order' => $order,
            'shippingInfo' => self::shippingInfo(),
        ]);
    }

    public static function shippingInfo(): string
    {
        return 'Ongkos kirim flat '.rupiah(Cart::SHIPPING_COST).' ke seluruh Indonesia, gratis untuk pembelian mulai '.rupiah(Cart::FREE_SHIPPING_MINIMUM).'.';
    }
}
