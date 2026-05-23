@extends('layouts.app')

@section('content')
<h1>Itens do pedido</h1>
<a href="{{ route('order-items.create') }}">Novo item</a>
<table>
    <tr><th>ID</th><th>Pedido</th><th>Produto</th><th>Qtd</th><th>Subtotal</th><th>Acoes</th></tr>
    @foreach($orderItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->product_id }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->subtotal }}</td>
            <td class="actions">
                <a href="{{ route('order-items.show', $item->id) }}">Ver</a>
                <a href="{{ route('order-items.edit', $item->id) }}">Editar</a>
                <form class="inline" method="POST" action="{{ route('order-items.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
