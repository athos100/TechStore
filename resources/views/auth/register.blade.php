@extends('layouts.app')

@section('content')
<div class="card section">
    <h1>Cadastro</h1>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <label>Nome</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
        <label>E-mail</label>
        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
        <label>Senha</label>
        <input class="form-control" type="password" name="password" required>
        <label>Confirmar senha</label>
        <input class="form-control" type="password" name="password_confirmation" required>
        <button class="btn" type="submit">Criar conta</button>
    </form>
</div>
@endsection
