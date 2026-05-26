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

        $reviews = $product->reviews()
            ->with('user')
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $reviewsCount = $product->reviews()->count();
        $averageRating = $reviewsCount > 0
            ? round((float) $product->reviews()->avg('rating'), 1)
            : 0.0;
        $userReview = auth()->check()
            ? $product->reviews()->where('user_id', auth()->id())->first()
            : null;

        return view('store.products.show', compact('product', 'averageRating', 'reviewsCount', 'userReview', 'reviews'));
    }
}
