<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'products' => Product::count(),
            'users' => User::count(),
            'orders' => Order::count(),
            'revenue' => (float) Order::where('status', '!=', 'cancelado')->sum('total'),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders'));
    }
}
