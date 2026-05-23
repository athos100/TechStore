@extends('layouts.app')

@section('content')
<h1>Pedido #{{ $order->id }}</h1>
<p><strong>Usuario:</strong> {{ $order->user_id }}</p>
<p><strong>Total:</strong> {{ $order->total }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Pagamento:</strong> {{ $order->payment_method }}</p>
<p><strong>Endereco:</strong> {{ $order->address }}</p>
@endsection
