@extends('layouts.app')

@section('content')
<section class="hero">
    <h1>Os melhores eletrônicos estão na TechStore</h1>
    <p>Produtos de qualidade com preço justo, compra segura e entrega rápida.</p>
    <a class="btn" href="{{ route('store.products.index') }}">Acessar catálogo</a>
</section>

<section class="section card">
    <h2>Categorias</h2>
    <div class="cats">
        @forelse($categories as $category)
            <a class="pill" href="{{ route('store.products.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
        @empty
            <p class="muted">Nenhuma categoria cadastrada.</p>
        @endforelse
    </div>
</section>

<section class="section">
    <h2>Produtos em destaque</h2>
    <div class="grid featured-products">
        @forelse($products as $product)
            <article class="card product-card">
                @if($product->main_image)
                    <img src="{{ asset('storage/' . $product->main_image) }}" class="product-img" alt="{{ $product->name }}">
                @else
                    <div class="product-img"></div>
                @endif
                <h3>{{ $product->name }}</h3>
                <p class="muted">{{ $product->category->name ?? 'Sem categoria' }}</p>
                <p><strong>R$ {{ number_format($product->price, 2, ',', '.') }}</strong></p>
                <a class="btn" href="{{ route('store.products.show', $product) }}">Ver detalhes</a>
            </article>
        @empty
            <p class="muted">Sem produtos cadastrados.</p>
        @endforelse
    </div>
</section>
@endsection
