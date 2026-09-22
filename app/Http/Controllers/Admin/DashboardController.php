<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'products' => Product::query()->orderBy('category')->orderBy('sort_order')->get(),
            'categoryCounts' => Product::CATEGORIES,
            'orders' => Order::with('items')->latest()->take(5)->get(),
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalRevenue' => (int) Order::sum('total'),
        ]);
    }
}
