<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Support\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeliaShopTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_beranda_menampilkan_shop_all_dan_banner(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Shop All')
            ->assertSee('Your Beauty')
            ->assertSee('Glow Ur Way, Everyday');
    }

    public function test_halaman_kategori_menampilkan_produk(): void
    {
        $this->get(route('products.category', 'skincare'))
            ->assertOk()
            ->assertSee('Produk Skincare')
            ->assertSee('Toner Pad Skintific')
            ->assertSee('Rp. 129.000');
    }

    public function test_kategori_yang_tidak_dikenal_menghasilkan_404(): void
    {
        $this->get('/produk/ngawur')->assertNotFound();
    }

    public function test_pencarian_produk(): void
    {
        $this->get(route('products.search', ['q' => 'serum']))
            ->assertOk()
            ->assertSee('Serum Skintific')
            ->assertDontSee('Eyeshadow Palet Salsa');
    }

    public function test_keranjang_dan_checkout_membuat_pesanan(): void
    {
        $product = Product::where('slug', 'serum-skintific')->firstOrFail();

        $this->post(route('cart.add', $product))->assertRedirect();

        $this->get(route('cart.index'))
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('Check Out');

        $this->post(route('cart.checkout'), ['selected' => [$product->id]])
            ->assertRedirect(route('checkout.index'));

        $this->get(route('checkout.index'))
            ->assertOk()
            ->assertSee('Metode Pembayaran')
            ->assertSee('Transfer Bank')
            ->assertSee('Ringkasan Pesanan');

        $response = $this->post(route('checkout.store'), [
            'customer_name' => 'Emre',
            'customer_phone' => '08123456789',
            'customer_address' => 'Jl. Merdeka No. 1, Bandung',
            'payment_method' => 'transfer',
        ]);

        $order = Order::with('items')->firstOrFail();

        $response->assertRedirect(route('checkout.success', $order->invoice_number));

        $this->assertSame($product->price, $order->subtotal);
        $this->assertSame(Cart::SHIPPING_COST, $order->shipping_cost);
        $this->assertSame($product->price + Cart::SHIPPING_COST, $order->total);
        $this->assertSame('Transfer Bank', $order->payment_label);
        $this->assertCount(1, $order->items);
        $this->assertSame($product->name, $order->items->first()->product_name);

        // Keranjang dikosongkan setelah pembayaran.
        $this->get(route('cart.index'))->assertSee('Keranjang belanja kamu masih kosong');
    }

    public function test_ongkos_kirim_gratis_di_atas_minimum(): void
    {
        $product = Product::where('slug', 'kylie-make-up-set')->firstOrFail();

        $this->post(route('cart.add', $product));
        $this->post(route('cart.checkout'), ['selected' => [$product->id]]);
        $this->post(route('checkout.store'), [
            'customer_name' => 'Emre',
            'customer_phone' => '08123456789',
            'customer_address' => 'Jl. Merdeka No. 1, Bandung',
            'payment_method' => 'cod',
        ]);

        $order = Order::firstOrFail();

        $this->assertSame(0, $order->shipping_cost);
        $this->assertSame($product->price, $order->total);
    }

    public function test_admin_bisa_masuk_dan_membuka_dashboard(): void
    {
        $this->post(route('admin.login.store'), [
            'login' => 'admin',
            'password' => 'admin123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Admin')
            ->assertSee('Daftar Produk');
    }

    public function test_pembeli_tidak_bisa_membuka_halaman_admin(): void
    {
        $buyer = User::where('role', 'user')->firstOrFail();

        $this->actingAs($buyer)->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_akun_admin_ditolak_di_halaman_masuk_pembeli(): void
    {
        $this->from(route('login'))
            ->post(route('login.store'), [
                'login' => 'admin@belia.test',
                'password' => 'admin123',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('login');
    }
}
