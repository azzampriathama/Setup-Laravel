<?php

namespace App\Support;

class Catalog
{
    public const CATEGORIES = [
        'skincare' => 'Skincare',
        'makeup' => 'Makeup',
        'bodycare' => 'Bodycare',
        'fragrance' => 'Fragrance',
        'sets' => 'Sets',
    ];

    public const PRODUCTS = [
        [
            'slug' => 'toner-pad-skintific',
            'name' => 'Toner Pad Skintific',
            'category' => 'skincare',
            'icon' => 'pad',
            'price' => 129000,
            'badge' => 'BEST SELLER',
            'featured' => true,
        ],
        [
            'slug' => 'serum-skintific',
            'name' => 'Serum Skintific',
            'category' => 'skincare',
            'icon' => 'serum',
            'price' => 89000,
            'badge' => null,
            'featured' => true,
        ],
        [
            'slug' => 'face-tonic-camille',
            'name' => 'Face Tonic Camille',
            'category' => 'skincare',
            'icon' => 'bottle',
            'price' => 65000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'facial-wash-skintific',
            'name' => 'Facial Wash Skintific',
            'category' => 'skincare',
            'icon' => 'tube',
            'price' => 55000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'sea-makeup-face-spray',
            'name' => 'Sea Makeup Face Spray',
            'category' => 'skincare',
            'icon' => 'spray',
            'price' => 70000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'wardah-sunscreen',
            'name' => 'Wardah Sunscreen',
            'category' => 'skincare',
            'icon' => 'sunscreen',
            'price' => 35000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'amaterasun-sunscreen',
            'name' => 'Amaterasun Sunscreen',
            'category' => 'skincare',
            'icon' => 'sunscreen',
            'price' => 48000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'vaseline-balm',
            'name' => 'Vaseline Balm',
            'category' => 'skincare',
            'icon' => 'jar',
            'price' => 32000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => '377-serum-skintific',
            'name' => '377 Serum Skintific',
            'category' => 'skincare',
            'icon' => 'serum',
            'price' => 58000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'sunscreen-serum-skintific',
            'name' => 'Sunscreen Serum Skintific',
            'category' => 'makeup',
            'icon' => 'tube',
            'price' => 95000,
            'badge' => null,
            'featured' => true,
        ],
        [
            'slug' => 'maybelline-sky-high-mascara',
            'name' => 'Maybelline Sky High Mascara',
            'category' => 'makeup',
            'icon' => 'mascara',
            'price' => 89000,
            'badge' => null,
            'featured' => true,
        ],
        [
            'slug' => 'cushion-skintific-glowy',
            'name' => 'Cushion Skintific Glowy',
            'category' => 'makeup',
            'icon' => 'cushion',
            'price' => 115000,
            'badge' => null,
            'featured' => true,
        ],
        [
            'slug' => 'rhode-lip-serum',
            'name' => 'Rhode Lip Serum',
            'category' => 'makeup',
            'icon' => 'lipstick',
            'price' => 75000,
            'badge' => null,
            'featured' => true,
        ],
        [
            'slug' => 'lip-serum-glad-to-glow',
            'name' => 'Lip Serum Glad To Glow',
            'category' => 'makeup',
            'icon' => 'lipstick',
            'price' => 68000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'setting-spray-dazzle-me',
            'name' => 'Setting Spray DAZZLE ME',
            'category' => 'makeup',
            'icon' => 'spray',
            'price' => 62000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'two-way-cake-omg',
            'name' => 'Two Way Cake OMG',
            'category' => 'makeup',
            'icon' => 'compact',
            'price' => 78000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'pinkflash-blush-on',
            'name' => 'PINKFLASH Blush On',
            'category' => 'makeup',
            'icon' => 'blush',
            'price' => 45000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'skintint-glad-to-glow',
            'name' => 'Skintint Glad To Glow',
            'category' => 'makeup',
            'icon' => 'tube',
            'price' => 72000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'tone-up-cream-scora',
            'name' => 'Tone Up Cream Scora',
            'category' => 'makeup',
            'icon' => 'tube',
            'price' => 58000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'eyeshadow-palet-salsa',
            'name' => 'Eyeshadow Palet Salsa',
            'category' => 'makeup',
            'icon' => 'palette',
            'price' => 92000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'micellar-water-garnier',
            'name' => 'Micellar Water Garnier',
            'category' => 'makeup',
            'icon' => 'bottle',
            'price' => 42000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'scarlet-body-lotion-whitening',
            'name' => 'Scarlet Body Lotion Whitening',
            'category' => 'bodycare',
            'icon' => 'bottle',
            'price' => 45000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'vaseline-hand-body',
            'name' => 'Vaseline Hand & Body',
            'category' => 'bodycare',
            'icon' => 'jar',
            'price' => 35000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'nivea-body-serum',
            'name' => 'Nivea Body Serum',
            'category' => 'bodycare',
            'icon' => 'bottle',
            'price' => 55000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'scrub-coffee-arabica',
            'name' => 'Scrub Coffee Arabica',
            'category' => 'bodycare',
            'icon' => 'jar',
            'price' => 48000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'belia-bloom-eau-de-parfum',
            'name' => 'Belia Bloom Eau de Parfum',
            'category' => 'fragrance',
            'icon' => 'perfume',
            'price' => 135000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'sweet-vanilla-body-mist',
            'name' => 'Sweet Vanilla Body Mist',
            'category' => 'fragrance',
            'icon' => 'spray',
            'price' => 65000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'floral-bliss-parfum',
            'name' => 'Floral Bliss Parfum',
            'category' => 'fragrance',
            'icon' => 'perfume',
            'price' => 145000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'kylie-make-up-set',
            'name' => 'Kylie Make Up Set',
            'category' => 'sets',
            'icon' => 'box',
            'price' => 350000,
            'badge' => 'NEW ARRIVAL',
            'featured' => true,
        ],
        [
            'slug' => 'skin-brightening-set',
            'name' => 'Skin Brightening Set',
            'category' => 'sets',
            'icon' => 'box',
            'price' => 285000,
            'badge' => 'NEW ARRIVAL',
            'featured' => true,
        ],
        [
            'slug' => 'skincare-basic-set',
            'name' => 'Skincare Basic Set',
            'category' => 'sets',
            'icon' => 'box',
            'price' => 199000,
            'badge' => null,
            'featured' => false,
        ],
        [
            'slug' => 'glow-up-complete-set',
            'name' => 'Glow Up Complete Set',
            'category' => 'sets',
            'icon' => 'box',
            'price' => 420000,
            'badge' => null,
            'featured' => false,
        ],
    ];

    protected const SHAPES = [
        'bottle' => "<rect x='23' y='24' width='18' height='32' rx='5'/><path d='M27 24v-6h10v6'/><path d='M27 13h10v5H27z'/><path d='M28 36h8M28 44h8'/>",
        'tube' => "<path d='M23 18h18v34a4 4 0 0 1-4 4H27a4 4 0 0 1-4-4V18Z'/><rect x='25' y='9' width='14' height='9' rx='2'/><path d='M28 32h8M28 40h8'/>",
        'serum' => "<rect x='23' y='26' width='18' height='30' rx='4'/><path d='M32 26v-9'/><rect x='28' y='9' width='8' height='8' rx='2'/><path d='M28 40h8'/>",
        'jar' => "<rect x='16' y='26' width='32' height='26' rx='7'/><rect x='14' y='17' width='36' height='9' rx='3'/>",
        'pad' => "<rect x='14' y='18' width='36' height='32' rx='5'/><path d='M14 27h36'/><circle cx='32' cy='39' r='7'/>",
        'sunscreen' => "<path d='M24 19h16v33a4 4 0 0 1-4 4h-8a4 4 0 0 1-4-4V19Z'/><path d='M24 14h16l-2 5H26l-2-5Z'/><path d='M29 34h6M29 42h6'/>",
        'mascara' => "<rect x='27' y='7' width='10' height='15' rx='3'/><rect x='24' y='26' width='16' height='31' rx='4'/><path d='M28 36h8'/>",
        'lipstick' => "<path d='M26 22h12v33a2 2 0 0 1-2 2h-8a2 2 0 0 1-2-2V22Z'/><path d='M28 22V10h8v12'/><path d='M26 30h12'/>",
        'cushion' => "<circle cx='32' cy='34' r='20'/><circle cx='32' cy='34' r='12'/>",
        'compact' => "<circle cx='32' cy='34' r='20'/><path d='M12 34h40'/><circle cx='32' cy='24' r='3'/>",
        'blush' => "<circle cx='27' cy='38' r='15'/><path d='M38 27l11-11'/><path d='M31 38a4 4 0 1 0-8 0'/>",
        'palette' => "<rect x='10' y='20' width='44' height='28' rx='5'/><circle cx='22' cy='30' r='4'/><circle cx='32' cy='30' r='4'/><circle cx='42' cy='30' r='4'/><rect x='16' y='38' width='32' height='6' rx='3'/>",
        'spray' => "<rect x='22' y='26' width='18' height='30' rx='4'/><path d='M26 26v-8h10v8'/><path d='M42 12h8M42 17h6'/>",
        'perfume' => "<rect x='20' y='28' width='24' height='28' rx='4'/><rect x='28' y='15' width='8' height='13' rx='2'/><path d='M40 19h6a2 2 0 0 1 2 2v4'/><circle cx='32' cy='42' r='5'/>",
        'box' => "<path d='M10 22 32 12l22 10v24L32 56 10 46V22Z'/><path d='M10 22l22 10 22-10M32 32v24'/>",
    ];

    public static function products(string $category = null, string $keyword = null): array
    {
        return collect(self::PRODUCTS)
            ->filter(function (array $product) use ($category, $keyword) {
                if ($category !== null && $product['category'] !== $category) {
                    return false;
                }

                if ($keyword !== null && $keyword !== ''
                    && ! str_contains(strtolower($product['name'].' '.($product['description'] ?? '')), strtolower($keyword))) {
                    return false;
                }

                return true;
            })
            ->values()
            ->all();
    }

    public static function find(string $slug): ?array
    {
        return collect(self::PRODUCTS)->firstWhere('slug', $slug);
    }

    public static function icon(string $name): string
    {
        return self::SHAPES[$name] ?? self::SHAPES['bottle'];
    }

    public static function svg(string $name, string $class = 'h-20 w-20'): string
    {
        return '<svg class="'.e($class).'" viewBox="0 0 64 64" fill="none" stroke="currentColor" '
            .'stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
            .self::icon($name)
            .'</svg>';
    }
}
