@extends('layouts.app')

@section('content')
<h1>Pedidos</h1>
<a href="{{ route('orders.create') }}">Novo pedido</a>
<table>
    <tr><th>ID</th><th>Usuario</th><th>Total</th><th>Status</th><th>Acoes</th></tr>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->status }}</td>
            <td class="actions">
                <a href="{{ route('orders.show', $order->id) }}">Ver</a>
                <a href="{{ route('orders.edit', $order->id) }}">Editar</a>
                <form class="inline" method="POST" action="{{ route('orders.destroy', $order->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
