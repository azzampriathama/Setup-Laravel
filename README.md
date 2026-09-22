# Belia Cosmetic — Implementasi Prototipe UI/UX ke Laravel

Hasil penerjemahan prototipe desain `contoh web/website belia.png` (toko kosmetik **Belia Cosmetic**)
menjadi aplikasi Laravel yang bisa langsung dijalankan.

Stack: **Laravel 13**, **Tailwind CSS 4**, **Vite**, **SQLite**.

## Daftar halaman

| Route | Halaman | Sesuai prototipe |
| --- | --- | --- |
| `GET /` | Beranda: header + pencarian, nav kategori, hero slider, **Shop All**, banner **NEW ARRIVAL**, footer | Ya |
| `GET /produk/{kategori}` | Listing **PRODUK SKINCARE / MAKEUP / BODYCARE / FRAGRANCE / SETS** (grid 3 kolom: gambar, nama, harga, tombol keranjang) | Ya |
| `GET /cari?q=` | Hasil pencarian dari kolom pencarian header | Tambahan |
| `GET /keranjang` | **Keranjang Belanja**: item, stepper −/+, Pilih Semua, Subtotal / Ongkos Kirim / Total, Check Out | Ya |
| `GET /checkout` | **Metode Pembayaran**: Transfer Bank, E-Wallet, COD + Ringkasan Pesanan + tombol **Bayar** | Ya |
| `GET /checkout/sukses/{invoice}` | Halaman invoice setelah pesanan dibuat | Tambahan |
| `GET /masuk` | **MASUK KE AKUN BELIA** (background doodle pink) | Ya |
| `GET /admin/masuk` | **MASUK SEBAGAI ADMIN** (background doodle ungu) | Ya |
| `GET /admin` | Dashboard admin: statistik, daftar produk, pesanan terbaru (login admin saja) | Tambahan |

## Cara menjalankan

Prasyarat: PHP 8.3+, Composer, Node.js 20+, dan ekstensi `pdo_sqlite` aktif di `php.ini`
(`extension=pdo_sqlite` — baris ini sudah diaktifkan di `C:\php\php.ini` pada mesin ini).

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Buka <http://127.0.0.1:8000>.

Saat pengembangan front-end, jalankan `npm run dev` (Vite) di terminal terpisah, atau
`composer run dev` untuk menjalankan server + Vite + log sekaligus.

## Akun demo

| Peran | Login | Kata sandi |
| --- | --- | --- |
| Admin | `admin` atau `admin@belia.test` | `admin123` |
| Pembeli | `beliauser` atau `user@belia.test` | `user123` |

## Alur belanja

1. Beranda / halaman kategori → klik **Masukkan Keranjang**.
2. `/keranjang` → centang produk yang ingin dibeli (atau **Pilih Semua**), lalu **Check Out**.
3. `/checkout` → pilih metode pembayaran, isi data penerima, klik **Bayar**.
4. Pesanan tersimpan di tabel `orders` + `order_items` dan halaman invoice muncul.

## Catatan teknis

- **Database SQLite**: file `database/database.sqlite`. Path-nya dibaca dari `DB_SQLITE_DATABASE`
  (bukan `DB_DATABASE`) karena di mesin ini ada environment variable sistem `DB_DATABASE=db_laravel_13`
  yang menimpa isi `.env`.
- **Gambar produk**: karena foto asli tidak tersedia, setiap produk memakai placeholder CSS
  (gradient sesuai kategori + ikon SVG di `App\Support\ProductIcon`). Kolom `products.icon`
  menentukan bentuk ikonnya.
- **Keranjang**: disimpan di session lewat `App\Support\Cart` (tidak perlu login untuk belanja).
- **Ongkos kirim**: flat Rp. 20.000, gratis untuk pembelian mulai Rp. 250.000.
- **Data produk**: `database/seeders/ProductSeeder.php` (29 produk, 5 kategori).
- **Test**: `php artisan test` — mencakup katalog, keranjang, checkout, dan proteksi halaman admin.

## Struktur penting

```
app/Http/Controllers/      HomeController, ProductController, CartController, CheckoutController, AuthController, Admin/DashboardController
app/Support/Cart.php       logika keranjang berbasis session
app/Support/ProductIcon.php ikon line-art pengganti foto produk
resources/views/           layouts, components (logo, kartu produk, visual produk), halaman
resources/css/app.css      tema warna Belia + pola doodle login
```

---

Dibangun di atas skeleton [Laravel](https://laravel.com).
