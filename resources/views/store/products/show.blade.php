@extends('layouts.app')

@section('content')
<article class="card section">
    <h1>{{ $product->name }}</h1>
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->name }}">
    @endif
    <p><strong>Categoria:</strong> {{ $product->category->name ?? 'Sem categoria' }}</p>
    <p><strong>Marca:</strong> {{ $product->brand ?: 'Nao informada' }}</p>
    <p>{{ $product->description }}</p>
    <p><strong>Preco:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    <p><strong>Estoque:</strong> {{ $product->stock }}</p>

    @if($product->manual_pdf)
        <p><a href="{{ asset('storage/' . $product->manual_pdf) }}" target="_blank">Abrir manual em PDF</a></p>
    @endif

    <form method="POST" action="{{ route('cart.add', $product) }}">
        @csrf
        <label>Quantidade</label>
        <input class="form-control" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required>
        <button class="btn" type="submit">Adicionar ao carrinho</button>
    </form>
</article>
@endsection
