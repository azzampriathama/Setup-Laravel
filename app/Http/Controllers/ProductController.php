<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, string $category): View
    {
        abort_unless(array_key_exists($category, Product::CATEGORIES), 404);

        $query = Product::query()->category($category);

        if ($keyword = trim((string) $request->query('q'))) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        return view('products.index', [
            'category' => $category,
            'categoryLabel' => Product::CATEGORIES[$category],
            'keyword' => $keyword ?? '',
            'products' => $query->orderBy('sort_order')->get(),
        ]);
    }

    /**
     * Pencarian produk dari kolom pencarian di header.
     */
    public function search(Request $request): View
    {
        $keyword = trim((string) $request->query('q'));

        $products = Product::query()
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->orderBy('sort_order')
            ->get();

        return view('products.index', [
            'category' => null,
            'categoryLabel' => 'Semua',
            'keyword' => $keyword,
            'products' => $products,
        ]);
    }
}
