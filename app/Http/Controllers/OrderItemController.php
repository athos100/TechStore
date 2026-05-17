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
        OrderItem::create($request->all());

        return redirect()->route('order-items.index');
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

        $orderItem->update($request->all());

        return redirect()->route('order-items.index');
    }

    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $orderItem->delete();

        return redirect()->route('order-items.index');
    }
}