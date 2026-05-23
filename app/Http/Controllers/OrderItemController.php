<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();

        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        return view('order_items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'subtotal' => ['required', 'numeric', 'min:0'],
        ]);

        OrderItem::create($validated);

        return redirect()->route('order-items.index')->with('success', 'Item do pedido criado com sucesso.');
    }

    public function show(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        return view('order_items.show', compact('orderItem'));
    }

    public function edit(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        return view('order_items.edit', compact('orderItem'));
    }

    public function update(Request $request, string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $validated = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'subtotal' => ['required', 'numeric', 'min:0'],
        ]);

        $orderItem->update($validated);

        return redirect()->route('order-items.index')->with('success', 'Item do pedido atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $orderItem->delete();

        return redirect()->route('order-items.index')->with('success', 'Item do pedido removido com sucesso.');
    }
}
