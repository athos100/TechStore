<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $allowedStatuses = ['pendente', 'pago', 'enviado', 'entregue', 'cancelado'];

        $orders = Order::with('user')
            ->when(in_array($status, $allowedStatuses, true), fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'status', 'allowedStatuses'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pendente,pago,enviado,entregue,cancelado'],
        ]);

        $oldStatus = $order->status;
        $newStatus = $data['status'];

        if ($oldStatus === 'cancelado' && $newStatus !== 'cancelado') {
            return back()->withErrors(['status' => 'Pedidos cancelados nao podem voltar para outro status.']);
        }

        DB::transaction(function () use ($order, $oldStatus, $newStatus): void {
            $order->load('items.product');

            // Entrando em cancelado: devolve ao estoque.
            if ($oldStatus !== 'cancelado' && $newStatus === 'cancelado') {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }

            $order->update(['status' => $newStatus]);
        });

        return back()->with('success', 'Status atualizado com sucesso.');
    }
}
