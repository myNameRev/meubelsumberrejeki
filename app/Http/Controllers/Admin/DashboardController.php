<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Mitra;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalFeatured = Product::where('is_featured', true)->count();
        $lowStock = Product::where('stock', '<', 5)->count();
        $totalMitraks = Mitra::count();

        $latestProducts = Product::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalFeatured',
            'lowStock',
            'totalMitraks',
            'latestProducts'
        ));
    }
}
