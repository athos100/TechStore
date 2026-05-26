@extends('layouts.app')

@section('content')
<h1>Novo item do pedido</h1>
<form method="POST" action="{{ route('order-items.store') }}">
    @csrf
    <label>Pedido (ID)</label>
<input type="number" name="order_id" required>
<label>Produto (ID)</label>
<input type="number" name="product_id" required>
<label>Quantidade</label>
<input type="number" name="quantity" required>
<label>Preço</label>
<input type="number" step="0.01" name="price" required>
<label>Subtotal</label>
<input type="number" step="0.01" name="subtotal" required>
<button type="submit">Salvar</button>
</form>
@endsection
