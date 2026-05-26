@extends('layouts.app')

@section('content')
<h1>Produto #{{ $product->id }}</h1>
<p>
<strong>Categoria:</strong> {{ $product->category_id }}</p>
<p>
<strong>Nome:</strong> {{ $product->name }}</p>
<p>
<strong>Descricao:</strong> {{ $product->description }}</p>
<p>
<strong>Preço:</strong> {{ $product->price }}</p>
<p>
<strong>Estoque:</strong> {{ $product->stock }}</p>
<p>
<strong>Imagem:</strong> {{ $product->image }}</p>
<p>
<strong>Marca:</strong> {{ $product->brand }}</p>
@endsection
