<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

// Controlador responsável por gerenciar a exibição da página inicial, incluindo a listagem de produtos em destaque e categorias. Ele serve como ponto de entrada para os usuários navegarem pelo catálogo de produtos e acessarem as funcionalidades principais da loja.
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        $products = Product::with('category')
            ->active()
            ->when($query, fn ($q) => $q->where('name', 'like', "%{$query}%"))
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('home', compact('products', 'categories', 'query'));
    }
}
