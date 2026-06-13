<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controlador responsável por gerenciar a exibição dos pedidos do usuário autenticado, permitindo que ele visualize o histórico de compras e os detalhes de cada pedido. Ele garante que apenas os pedidos do usuário logado sejam acessíveis, mantendo a privacidade e segurança dos dados.
class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('items.product')->latest()->get();

        return view('store.orders.index', compact('orders'));
    }
}
