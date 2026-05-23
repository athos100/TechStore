@extends('layouts.app')

@section('content')
<h1>Cadastrar produto</h1>
<div class="card section">
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products.partials.form')
        <button class="btn" type="submit">Salvar</button>
    </form>
</div>
@endsection
