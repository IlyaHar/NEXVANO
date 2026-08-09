<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'categories' => Category::withCount('products')->orderBy('sort_order')->get(),
            'products' => Product::active()->featured()->with('categories')->take(3)->get(),
            'partners' => Partner::visible()->get(),
        ]);
    }
}
