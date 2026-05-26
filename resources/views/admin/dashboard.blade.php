@extends('layouts.app')

@section('content')
<h1>Painel Administrativo</h1>
<div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
<div class="card">
<h3>Produtos</h3>
<p>{{ $metrics['products'] }}</p>
</div>
<div class="card">
<h3>Usuários</h3>
<p>{{ $metrics['users'] }}</p>
</div>
<div class="card">
<h3>Pedidos</h3>
<p>{{ $metrics['orders'] }}</p>
</div>
<div class="card">
<h3>Faturamento</h3>
<p>R$ {{ number_format($metrics['revenue'], 2, ',', '.') }}</p>
</div>
</div>
<div class="card section">
<h2>Atalhos</h2>
<p>
<a href="{{ route('admin.products.index') }}">Gerenciar produtos</a>
</p>
<p>
<a href="{{ route('admin.orders.index') }}">Gerenciar pedidos</a>
</p>
<p>
<a href="{{ route('admin.users.index') }}">Gerenciar usuários</a>
</p>
</div>
<div class="card section">
<h2>Pedidos recentes</h2>
<table>
<tr>
<th>ID</th>
<th>Cliente</th>
<th>Total</th>
<th>Status</th>
</tr>
        @foreach($recentOrders as $order)
            <tr>
<td>#{{ $order->id }}</td>
<td>{{ $order->user->name ?? 'N/A' }}</td>
<td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
<td>{{ $order->status }}</td>
</tr>
        @endforeach
    </table>
</div>
@endsection
