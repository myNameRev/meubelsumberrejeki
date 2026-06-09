<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $featuredProducts = Product::where('is_featured', true)
            ->latest()
            ->limit(6)
            ->get();
        $latestProducts = Product::latest()
            ->limit(8)
            ->get();

        return view('home.index', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
