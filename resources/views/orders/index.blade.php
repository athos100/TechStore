@extends('layouts.app')

@section('content')
<h1>Pedidos</h1>
<a class="btn" href="{{ route('orders.create') }}">Novo pedido</a>
<table>
    <tr>
        <th>ID</th>
        <th>Usuário</th>
        <th>Total</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('orders.show', $order->id) }}">Ver</a>
                    <a class="btn btn-edit" href="{{ route('orders.edit', $order->id) }}">Editar</a>
                    <form class="inline" method="POST" action="{{ route('orders.destroy', $order->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">Excluir</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</table>
@endsection
