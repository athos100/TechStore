@extends('layouts.app')

@section('content')
<h1>Item #{{ $orderItem->id }}</h1>
<p><strong>Pedido:</strong> {{ $orderItem->order_id }}</p>
<p><strong>Produto:</strong> {{ $orderItem->product_id }}</p>
<p><strong>Quantidade:</strong> {{ $orderItem->quantity }}</p>
<p><strong>Preco:</strong> {{ $orderItem->price }}</p>
<p><strong>Subtotal:</strong> {{ $orderItem->subtotal }}</p>
@endsection
