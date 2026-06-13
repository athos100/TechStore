<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// Controlador responsável por gerenciar as operações do carrinho de compras, incluindo exibição, adição, atualização e remoção de itens. O carrinho é armazenado na sessão do usuário para persistência temporária dos dados.
class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['quantity'] * $item['price']);

        return view('store.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        if (! $product->is_active) {
            return redirect()->route('store.products.index')->withErrors(['product' => 'Este produto não está disponível para compra.']);
        }

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);
        $productId = (string) $product->id;
        $quantity = $data['quantity'];

        if ($quantity > $product->stock) {
            return back()->withErrors(['quantity' => 'Quantidade maior que o estoque disponível.']);
        }

        if (isset($cart[$productId])) {
            $quantity += $cart[$productId]['quantity'];
        }

        if ($quantity > $product->stock) {
            return back()->withErrors(['quantity' => 'A soma no carrinho ultrapassa o estoque disponível.']);
        }

        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'quantity' => $quantity,
            'image' => $product->image,
            'stock' => $product->stock,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produto adicionado ao carrinho.');
    }

    public function update(Request $request, Product $product)
    {
        if (! $product->is_active) {
            return redirect()->route('cart.index')->withErrors(['product' => 'Este produto não está disponível para compra.']);
        }

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);
        $productId = (string) $product->id;

        if (! isset($cart[$productId])) {
            return redirect()->route('cart.index');
        }

        if ($data['quantity'] > $product->stock) {
            return back()->withErrors(['quantity' => 'Quantidade maior que o estoque disponível.']);
        }

        $cart[$productId]['quantity'] = $data['quantity'];
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Carrinho atualizado.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[(string) $product->id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removido do carrinho.');
    }
}
