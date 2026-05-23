@extends('layouts.app')

@section('content')
<h1>Editar categoria</h1>
<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PUT')
    <label>Nome</label>
    <input type="text" name="name" value="{{ $category->name }}" required>
    <label>Descricao</label>
    <textarea name="description">{{ $category->description }}</textarea>
    <button type="submit">Atualizar</button>
</form>
@endsection
