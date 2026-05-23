@extends('layouts.app')

@section('content')
<h1>Pedidos (Admin)</h1>
<div class="card section">
    <table>
        <tr><th>ID</th><th>Cliente</th><th>Total</th><th>Status</th><th>Acoes</th></tr>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                <td>{{ $order->status }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}">Ver</a></td>
            </tr>
        @endforeach
    </table>
    <div class="section">{{ $orders->links() }}</div>
</div>
@endsection
