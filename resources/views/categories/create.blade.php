@extends('layouts.app')

@section('content')
<h1>Nova categoria</h1>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <label>Nome</label>
<input type="text" name="name" required>
<label>Descricao</label>
<textarea name="description">
</textarea>
<button type="submit">Salvar</button>
</form>
@endsection
