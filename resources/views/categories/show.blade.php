@extends('layouts.app')

@section('content')
<h1>Categoria #{{ $category->id }}</h1>
<p><strong>Nome:</strong> {{ $category->name }}</p>
<p><strong>Descricao:</strong> {{ $category->description }}</p>
@endsection
