@extends('layouts.app')

@section('content')
<h1>Novo produto</h1>
<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <label>Categoria (ID)</label>
    <input type="number" name="category_id" required>
    <label>Nome</label>
    <input type="text" name="name" required>
    <label>Descricao</label>
    <textarea name="description" required></textarea>
    <label>Preco</label>
    <input type="number" step="0.01" name="price" required>
    <label>Estoque</label>
    <input type="number" name="stock" required>
    <label>Imagem (URL/caminho)</label>
    <input type="text" name="image">
    <label>Marca</label>
    <input type="text" name="brand">
    <button type="submit">Salvar</button>
</form>
@endsection
