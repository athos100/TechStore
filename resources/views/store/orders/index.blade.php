@extends('layouts.app')

@section('content')
<h1>Meus pedidos</h1>
<div class="card section">
    @forelse($orders as $order)
        <article style="margin-bottom:14px;border-bottom:1px solid #e5e7eb;padding-bottom:10px;">
            <h3>Pedido #{{ $order->id }} - {{ ucfirst($order->status) }}</h3>
            <p><strong>Total:</strong> R$ {{ number_format($order->total, 2, ',', '.') }}</p>
            <p><strong>Pagamento:</strong> {{ $order->payment_method }}</p>
            <p><strong>Endereco:</strong> {{ $order->address }}</p>
            <ul>
                @foreach($order->items as $item)
                    <li>{{ $item->product->name ?? 'Produto removido' }} | {{ $item->quantity }} x R$ {{ number_format($item->price, 2, ',', '.') }}</li>
                @endforeach
            </ul>
        </article>
    @empty
        <p>Voce ainda nao fez pedidos.</p>
    @endforelse
</div>
@endsection
