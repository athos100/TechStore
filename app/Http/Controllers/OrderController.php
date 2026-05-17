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
        Order::create($request->all());

        return redirect()->route('orders.index');
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

        $order->update($request->all());

        return redirect()->route('orders.index');
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->route('orders.index');
    }
}