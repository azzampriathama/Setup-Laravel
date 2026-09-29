<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
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
        $products = collect(Catalog::PRODUCTS)->keyBy('slug');

        return view('home', [
            'slides' => self::SLIDES,
            'shopAll' => $products->where('featured', true)->values(),
            'newArrivals' => $products->where('category', 'sets')->where('badge', 'NEW ARRIVAL')->values(),
        ]);
    }
}
