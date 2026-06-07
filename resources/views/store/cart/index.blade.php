@extends('layouts.app')

@section('content')
<h1>Carrinho de compras</h1>
<div class="card section">
    @if(empty($cart))
        <p>Seu carrinho está vazio.</p>
    @else
        <table>
<tr>
<th>Produto</th>
<th>Preço</th>
<th>Qtd</th>
<th>Subtotal</th>
<th>Ações</th>
</tr>
            @foreach($cart as $item)
                <tr>
<td>{{ $item['name'] }}</td>
<td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
<td>
<form method="POST" action="{{ route('cart.update', $item['id']) }}" style="display:flex;gap:6px;">
                            @csrf
                            @method('PUT')
                            <input class="form-control" type="number" name="quantity" min="1" max="{{ $item['stock'] }}" value="{{ $item['quantity'] }}">
<button class="btn" type="submit">Atualizar</button>
</form>
</td>
<td>R$ {{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }}</td>
<td>
<form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn secondary" type="submit">Remover</button>
</form>
</td>
</tr>
            @endforeach
        </table>
<p>
<strong>Total: R$ {{ number_format($total, 2, ',', '.') }}</strong>
</p>
<a class="btn" href="{{ route('checkout.show') }}">Finalizar pedido</a>
    @endif
</div>
@endsection
