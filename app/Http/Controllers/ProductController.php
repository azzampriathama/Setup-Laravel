<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, string $category): View
    {
        abort_unless(array_key_exists($category, Catalog::CATEGORIES), 404);

        $keyword = trim((string) $request->query('q'));

        return view('products.index', [
            'category' => $category,
            'categoryLabel' => Catalog::CATEGORIES[$category],
            'keyword' => $keyword,
            'products' => collect(Catalog::products($category, $keyword)),
        ]);
    }

    public function search(Request $request): View
    {
        $keyword = trim((string) $request->query('q'));

        return view('products.index', [
            'category' => null,
            'categoryLabel' => 'Semua',
            'keyword' => $keyword,
            'products' => collect(Catalog::products(null, $keyword)),
        ]);
    }
}
