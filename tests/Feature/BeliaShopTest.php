<?php

namespace Tests\Feature;

use App\Models\User;
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
            ->assertSee('Toner Pad Skintific');
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

    public function test_halaman_keranjang_dan_checkout_tampil(): void
    {
        $this->get(route('cart.index'))
            ->assertOk()
            ->assertSee('Keranjang Belanja')
            ->assertSee('Check Out');

        $this->get(route('checkout.index'))
            ->assertOk()
            ->assertSee('Metode Pembayaran')
            ->assertSee('Transfer Bank')
            ->assertSee('Ringkasan Pesanan');
    }

    public function test_pembeli_bisa_masuk_dan_keluar(): void
    {
        $this->post(route('login.store'), [
            'login' => 'user@belia.test',
            'password' => 'user123',
        ])->assertRedirect(route('home'));

        $this->post(route('logout'))->assertRedirect(route('home'));
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
            ->assertSee('Pesanan Terbaru');
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

    public function test_akun_pembeli_ditolak_di_halaman_masuk_admin(): void
    {
        $this->from(route('admin.login'))
            ->post(route('admin.login.store'), [
                'login' => 'user@belia.test',
                'password' => 'user123',
            ])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('login');
    }
}
