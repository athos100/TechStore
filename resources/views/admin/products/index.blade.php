@extends('layouts.app')

@section('content')
<h1>Produtos (Admin)</h1>
<div style="margin: 8px 0 18px;">
    <a class="btn" href="{{ route('admin.products.create') }}">Cadastrar produto</a>
</div>

<div class="card section">
    <form method="GET" action="{{ route('admin.products.index') }}" style="display:flex;gap:8px;align-items:end;flex-wrap:wrap;">
        <div>
            <label for="status">Filtrar por status</label>
            <select id="status" class="form-control" name="status" style="min-width:220px;">
                <option value="all" @selected($status === 'all')>Todos</option>
                <option value="active" @selected($status === 'active')>Ativos</option>
                <option value="inactive" @selected($status === 'inactive')>Inativos</option>
            </select>
        </div>

        <button class="btn" type="submit">Filtrar</button>

        @if($status !== 'all')
            <a class="btn secondary" href="{{ route('admin.products.index') }}">Limpar filtro</a>
        @endif
    </form>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'Sem categoria' }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->is_active ? 'Ativo' : 'Inativo' }}</td>
            <td>
                <div class="action-buttons">
                    <a class="btn btn-edit" href="{{ route('admin.products.edit', $product) }}">Editar</a>
                    @if($product->is_active)
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Tem certeza que deseja desativar este produto? Ele deixará de aparecer no catálogo.');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">Desativar</button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('admin.products.reactivate', $product) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn" type="submit">Reativar</button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
</table>

<div class="section">{{ $products->links() }}</div>
@endsection
