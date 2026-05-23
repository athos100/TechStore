@extends('layouts.app')

@section('content')
<h1>Produtos (Admin)</h1>
<p><a class="btn" href="{{ route('admin.products.create') }}">Cadastrar produto</a></p>
<table>
    <tr><th>ID</th><th>Nome</th><th>Categoria</th><th>Preco</th><th>Estoque</th><th>Acoes</th></tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'Sem categoria' }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}">Editar</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn secondary" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div class="section">{{ $products->links() }}</div>
@endsection
