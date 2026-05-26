@extends('layouts.app')

@section('content')
<div class="card section">
    <h1>Catálogo de produtos</h1>
    <form method="GET" action="{{ route('store.products.index') }}" style="display:grid;grid-template-columns:2fr 1fr auto;gap:8px;">
        <input class="form-control" name="q" value="{{ $query }}" placeholder="Buscar por nome">
        <select class="form-control" name="category">
            <option value="">Todas categorias</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string)$categoryId === (string)$category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="btn" type="submit">Filtrar</button>
    </form>
</div>

<div class="grid products">
    @forelse($products as $product)
        <article class="card product-card">
            @if($product->main_image)
                <img src="{{ asset('storage/' . $product->main_image) }}" class="product-img" alt="{{ $product->name }}">
            @else
                <div class="product-img"></div>
            @endif
            <h3>{{ $product->name }}</h3>
            <p class="muted">{{ $product->brand ?: 'Sem marca' }}</p>
            <p>{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
            <p><strong>R$ {{ number_format($product->price, 2, ',', '.') }}</strong></p>
            <a class="btn" href="{{ route('store.products.show', $product) }}">Detalhes</a>
        </article>
    @empty
        <p class="muted">Nenhum produto encontrado.</p>
    @endforelse
</div>

<div class="section">{{ $products->links() }}</div>
@endsection
