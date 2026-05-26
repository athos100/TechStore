@extends('layouts.app')

@section('content')
<h1>Editar produto</h1>
<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')
    <label>Categoria (ID)</label>
<input type="number" name="category_id" value="{{ $product->category_id }}" required>
<label>Nome</label>
<input type="text" name="name" value="{{ $product->name }}" required>
<label>Descricao</label>
<textarea name="description" required>{{ $product->description }}</textarea>
<label>Preço</label>
<input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
<label>Estoque</label>
<input type="number" name="stock" value="{{ $product->stock }}" required>
<label>Imagem (URL/caminho)</label>
<input type="text" name="image" value="{{ $product->image }}">
<label>Marca</label>
<input type="text" name="brand" value="{{ $product->brand }}">
<button type="submit">Atualizar</button>
</form>
@endsection
