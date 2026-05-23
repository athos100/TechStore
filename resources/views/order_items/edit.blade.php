@extends('layouts.app')

@section('content')
<h1>Editar item do pedido</h1>
<form method="POST" action="{{ route('order-items.update', $orderItem->id) }}">
    @csrf
    @method('PUT')
    <label>Pedido (ID)</label>
    <input type="number" name="order_id" value="{{ $orderItem->order_id }}" required>
    <label>Produto (ID)</label>
    <input type="number" name="product_id" value="{{ $orderItem->product_id }}" required>
    <label>Quantidade</label>
    <input type="number" name="quantity" value="{{ $orderItem->quantity }}" required>
    <label>Preco</label>
    <input type="number" step="0.01" name="price" value="{{ $orderItem->price }}" required>
    <label>Subtotal</label>
    <input type="number" step="0.01" name="subtotal" value="{{ $orderItem->subtotal }}" required>
    <button type="submit">Atualizar</button>
</form>
@endsection
