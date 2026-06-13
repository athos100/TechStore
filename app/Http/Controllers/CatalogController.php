<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

// Controlador responsável por gerenciar a exibição do catálogo de produtos, incluindo listagem, detalhes e avaliações. Ele permite que os usuários naveguem pelos produtos disponíveis, visualizem informações detalhadas e interajam com as avaliações dos produtos.
class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');
        $categoryId = $request->query('category');

        $products = Product::with('category')
            ->active()
            ->when($query, fn ($q) => $q->where('name', 'like', "%{$query}%"))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('store.products.index', compact('products', 'categories', 'query', 'categoryId'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

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
        $canReview = auth()->check()
            ? auth()->user()-> orders()
                ->where('status', 'entregue')
                ->whereHas('items', fn ($q) => $q->where('product_id', $product->id))
                ->exists()
            : false;

        return view('store.products.show', compact('product', 'averageRating', 'reviewsCount', 'userReview', 'reviews', 'canReview'));
    }
}
