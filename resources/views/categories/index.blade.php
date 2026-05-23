@extends('layouts.app')

@section('content')
<h1>Categorias</h1>
<a href="{{ route('categories.create') }}">Nova categoria</a>
<table>
    <tr><th>ID</th><th>Nome</th><th>Descricao</th><th>Acoes</th></tr>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td class="actions">
                <a href="{{ route('categories.show', $category->id) }}">Ver</a>
                <a href="{{ route('categories.edit', $category->id) }}">Editar</a>
                <form class="inline" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
