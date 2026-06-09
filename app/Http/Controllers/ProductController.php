<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show($slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        $categories = Category::all();

        return view('products.show', compact('product', 'relatedProducts', 'categories'));
    }
}
