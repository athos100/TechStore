@extends('layouts.app')

@section('content')
<h1>Categorias</h1>
<a class="btn" href="{{ route('categories.create') }}">Nova categoria</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('categories.show', $category->id) }}">Ver</a>
                    <a class="btn btn-edit" href="{{ route('categories.edit', $category->id) }}">Editar</a>
                    <form class="inline" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">Excluir</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</table>
@endsection
