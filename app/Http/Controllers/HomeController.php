<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        $products = Product::with('category')
            ->when($query, fn ($q) => $q->where('name', 'like', "%{$query}%"))
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('home', compact('products', 'categories', 'query'));
    }
}
