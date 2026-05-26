@extends('layouts.app')

@section('content')
<h1>Produtos (Admin)</h1>
<div style="margin: 8px 0 28px;">
    <a class="btn" href="{{ route('admin.products.create') }}">Cadastrar produto</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'Sem categoria' }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <div class="action-buttons">
                    <a class="btn btn-edit" href="{{ route('admin.products.edit', $product) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">Excluir</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</table>

<div class="section">{{ $products->links() }}</div>
@endsection
