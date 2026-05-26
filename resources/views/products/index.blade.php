@extends('layouts.app')

@section('content')
<h1>Produtos</h1>
<a class="btn" href="{{ route('products.create') }}">Novo produto</a>
<table>
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category_id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('products.show', $product->id) }}">Ver</a>
                    <a class="btn btn-edit" href="{{ route('products.edit', $product->id) }}">Editar</a>
                    <form class="inline" method="POST" action="{{ route('products.destroy', $product->id) }}">
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
