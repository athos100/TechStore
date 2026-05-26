@extends('layouts.app')

@section('content')
<h1>Editar produto</h1>
<div class="card section">
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.products.partials.form')
        <button class="btn" type="submit">Atualizar</button>
</form>
</div>
@endsection
