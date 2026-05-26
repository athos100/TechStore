@extends('layouts.app')

@section('content')
<h1>Pedidos (Admin)</h1>

<div class="card section">
    <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex;gap:8px;align-items:end;flex-wrap:wrap;margin-bottom:16px;">
        <div>
            <label for="status">Filtrar por status</label>
            <select id="status" class="form-control" name="status" style="min-width:220px;">
                <option value="">Todos</option>
                @foreach($allowedStatuses as $item)
                    <option value="{{ $item }}" @selected($status === $item)>{{ ucfirst($item) }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn" type="submit">Filtrar</button>

        @if(!empty($status))
            <a class="btn secondary" href="{{ route('admin.orders.index') }}">Limpar filtro</a>
        @endif
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
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
