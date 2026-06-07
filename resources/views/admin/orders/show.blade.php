@extends('layouts.app')

@section('content')
<h1>Pedido #{{ $order->id }}</h1>

<div class="card section">
    <p><strong>Cliente:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($order->total, 2, ',', '.') }}</p>
    <p><strong>Endereço:</strong> {{ $order->address }}</p>

    @if($order->status === 'cancelado')
        <p><strong>Status:</strong> Cancelado</p>
        <p class="muted">Pedidos cancelados não podem voltar para outro status.</p>
    @else
    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
        @csrf
        @method('PATCH')

        <label>Status</label>
        <select class="form-control" name="status">
            @foreach(['pendente', 'pago', 'enviado', 'entregue', 'cancelado'] as $status)
                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <button class="btn" type="submit">Atualizar status</button>
    </form>
    @endif

    <h3>Itens</h3>
    <table>
        <tr>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Preço</th>
            <th>Subtotal</th>
        </tr>

        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Produto removido' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
