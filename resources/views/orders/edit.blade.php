@extends('layouts.app')

@section('content')
<h1>Editar pedido</h1>
<form method="POST" action="{{ route('orders.update', $order->id) }}">
    @csrf
    @method('PUT')
    <label>Usuário (ID)</label>
<input type="number" name="user_id" value="{{ $order->user_id }}" required>
<label>Total</label>
<input type="number" step="0.01" name="total" value="{{ $order->total }}" required>
<label>Status</label>
<input type="text" name="status" value="{{ $order->status }}" required>
<label>Método de pagamento</label>
<input type="text" name="payment_method" value="{{ $order->payment_method }}" required>
<label>Endereço</label>
<input type="text" name="address" value="{{ $order->address }}" required>
<button type="submit">Atualizar</button>
</form>
@endsection
