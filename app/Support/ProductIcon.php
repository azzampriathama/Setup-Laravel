<?php

namespace App\Support;

/**
 * Gambar produk pada prototipe berupa foto. Karena proyek ini memakai
 * placeholder CSS, setiap produk dipetakan ke ikon line-art sesuai bentuknya.
 */
class ProductIcon
{
    /**
     * @var array<string, string>
     */
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

    public static function markup(string $icon): string
    {
        return self::SHAPES[$icon] ?? self::SHAPES['bottle'];
    }

    /**
     * @return array<int, string>
     */
    public static function available(): array
    {
        return array_keys(self::SHAPES);
    }

    /**
     * SVG lengkap siap tempel di Blade.
     */
    public static function svg(string $icon, string $class = 'h-20 w-20'): string
    {
        return '<svg class="'.e($class).'" viewBox="0 0 64 64" fill="none" stroke="currentColor" '
            .'stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
            .self::markup($icon)
            .'</svg>';
    }
}
