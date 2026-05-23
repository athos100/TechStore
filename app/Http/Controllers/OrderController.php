<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Pedido criado com sucesso.');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido removido com sucesso.');
    }
}
