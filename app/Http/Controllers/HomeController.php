<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Banner slider di halaman beranda.
     *
     * @var array<int, array{title: string, subtitle: string, text: string, cta: string, category: string}>
     */
    public const SLIDES = [
        [
            'eyebrow' => 'Your Beauty',
            'title' => 'Our Priority',
            'text' => 'Temukan Produk Kecantikan terbaik untuk versi terbaik dirimu!',
            'cta' => 'Belanja Sekarang',
            'category' => 'skincare',
            'theme' => 'pink',
        ],
        [
            'eyebrow' => 'New Arrival',
            'title' => 'Kylie Make Up Set',
            'text' => 'Lengkapi tampilan make up harianmu dengan set eksklusif Belia.',
            'cta' => 'Belanja Sekarang',
            'category' => 'sets',
            'theme' => 'rose',
        ],
        [
            'eyebrow' => 'Glow Up',
            'title' => 'Every Single Day',
            'text' => 'Rangkaian skincare untuk kulit cerah, sehat, dan bercahaya.',
            'cta' => 'Belanja Sekarang',
            'category' => 'skincare',
            'theme' => 'amber',
        ],
        [
            'eyebrow' => 'Promo Spesial',
            'title' => 'Diskon Hingga 20%',
            'text' => 'Belanja produk favoritmu, gratis ongkir ke seluruh Indonesia.',
            'cta' => 'Belanja Sekarang',
            'category' => 'makeup',
            'theme' => 'fuchsia',
        ],
    ];

    public function index(): View
    {
        return view('home', [
            'slides' => self::SLIDES,
            'shopAll' => Product::query()->featured()->orderBy('sort_order')->get(),
            'newArrivals' => Product::query()
                ->category('sets')
                ->orderBy('sort_order')
                ->take(2)
                ->get(),
        ]);
    }
}
