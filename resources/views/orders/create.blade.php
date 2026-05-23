@extends('layouts.app')

@section('content')
<h1>Novo pedido</h1>
<form method="POST" action="{{ route('orders.store') }}">
    @csrf
    <label>Usuario (ID)</label>
    <input type="number" name="user_id" required>
    <label>Total</label>
    <input type="number" step="0.01" name="total" required>
    <label>Status</label>
    <input type="text" name="status" value="pendente" required>
    <label>Metodo de pagamento</label>
    <input type="text" name="payment_method" required>
    <label>Endereco</label>
    <input type="text" name="address" required>
    <button type="submit">Salvar</button>
</form>
@endsection
