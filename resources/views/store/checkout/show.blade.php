@extends('layouts.app')

@section('content')
<h1>Finalizacao do pedido</h1>
<div class="card section">
    <table>
        <tr><th>Produto</th><th>Qtd</th><th>Subtotal</th></tr>
        @foreach($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>R$ {{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
    <p><strong>Total: R$ {{ number_format($total, 2, ',', '.') }}</strong></p>

    <form method="POST" action="{{ route('checkout.place') }}">
        @csrf
        <label>Endereco de entrega</label>
        <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>

        <label>Forma de pagamento</label>
        <select class="form-control" name="payment_method" required>
            <option value="cartao">Cartao</option>
            <option value="pix">PIX</option>
            <option value="boleto">Boleto</option>
        </select>

        <button class="btn" type="submit">Confirmar pedido</button>
    </form>
</div>
@endsection
