<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Daftar produk yang tampil pada prototipe Belia Cosmetic.
     * Urutan: [nama, harga, icon, badge, featured]
     *
     * @var array<string, array<int, array{0: string, 1: int, 2: string, 3?: string, 4?: bool}>>
     */
    protected array $products = [
        'skincare' => [
            ['Toner Pad Skintific', 129000, 'pad', 'BEST SELLER'],
            ['Serum Skintific', 89000, 'serum'],
            ['Face Tonic Camille', 65000, 'bottle'],
            ['Facial Wash Skintific', 55000, 'tube'],
            ['Sea Makeup Face Spray', 70000, 'spray'],
            ['Wardah Sunscreen', 35000, 'sunscreen'],
            ['Amaterasun Sunscreen', 48000, 'sunscreen'],
            ['Vaseline Balm', 32000, 'jar'],
            ['377 Serum Skintific', 58000, 'serum'],
        ],
        'makeup' => [
            ['Sunscreen Serum Skintific', 95000, 'tube', null, true],
            ['Maybelline Sky High Mascara', 89000, 'mascara', null, true],
            ['Cushion Skintific Glowy', 115000, 'cushion', null, true],
            ['Rhode Lip Serum', 75000, 'lipstick', null, true],
            ['Lip Serum Glad To Glow', 68000, 'lipstick'],
            ['Setting Spray DAZZLE ME', 62000, 'spray'],
            ['Two Way Cake OMG', 78000, 'compact'],
            ['PINKFLASH Blush On', 45000, 'blush'],
            ['Skintint Glad To Glow', 72000, 'tube'],
            ['Tone Up Cream Scora', 58000, 'tube'],
            ['Eyeshadow Palet Salsa', 92000, 'palette'],
            ['Micellar Water Garnier', 42000, 'bottle'],
        ],
        'bodycare' => [
            ['Scarlet Body Lotion Whitening', 45000, 'bottle'],
            ['Vaseline Hand & Body', 35000, 'jar'],
            ['Nivea Body Serum', 55000, 'bottle'],
            ['Scrub Coffee Arabica', 48000, 'jar'],
        ],
        'fragrance' => [
            ['Belia Bloom Eau de Parfum', 135000, 'perfume'],
            ['Sweet Vanilla Body Mist', 65000, 'spray'],
            ['Floral Bliss Parfum', 145000, 'perfume'],
        ],
        'sets' => [
            ['Kylie Make Up Set', 350000, 'box', 'NEW ARRIVAL', true],
            ['Skin Brightening Set', 285000, 'box', 'NEW ARRIVAL', true],
            ['Skincare Basic Set', 199000, 'box'],
            ['Glow Up Complete Set', 420000, 'box'],
        ],
    ];

    public function run(): void
    {
        $order = 0;

        foreach ($this->products as $category => $items) {
            foreach ($items as $item) {
                [$name, $price, $icon] = $item;
                $badge = $item[3] ?? null;
                $featured = $item[4] ?? false;

                Product::updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'category' => $category,
                        'icon' => $icon,
                        'price' => $price,
                        'badge' => $badge,
                        'description' => "{$name} original dan siap kirim dari Belia Cosmetic.",
                        'is_featured' => $featured,
                        'sort_order' => $order++,
                    ]
                );
            }
        }
    }
}
