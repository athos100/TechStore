<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('items.product')->latest()->get();

        return view('store.orders.index', compact('orders'));
    }
}
