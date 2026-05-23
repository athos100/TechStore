<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');
        $categoryId = $request->query('category');

        $products = Product::with('category')
            ->when($query, fn ($q) => $q->where('name', 'like', "%{$query}%"))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('store.products.index', compact('products', 'categories', 'query', 'categoryId'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('store.products.show', compact('product'));
    }
}
