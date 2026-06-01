<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.products.index')->withErrors(['cart' => 'Seu carrinho esta vazio.']);
        }

        $total = collect($cart)->sum(fn ($item) => $item['quantity'] * $item['price']);

        return view('store.checkout.show', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $data = $request->validate([
            'address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cartao,pix,boleto'],
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.products.index')->withErrors(['cart' => 'Seu carrinho esta vazio.']);
        }

        $total = collect($cart)->sum(fn ($item) => $item['quantity'] * $item['price']);

        DB::transaction(function () use ($cart, $data, $total, $request): void {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total' => $total,
                'status' => 'pendente',
                'payment_method' => $data['payment_method'],
                'address' => $data['address'],
            ]);

            foreach ($cart as $item) {
                $product = \App\Models\Product::lockForUpdate()->findOrFail($item['id']);

                if (! $product->is_active) {
                    abort(422, 'Produto indisponivel para compra: ' . $product->name);
                }

                if ($item['quantity'] > $product->stock) {
                    abort(422, 'Estoque insuficiente para o produto: ' . $product->name);
                }

                $product->decrement('stock', $item['quantity']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('orders.my')->with('success', 'Pedido realizado com sucesso.');
    }
}
