@extends('layouts.app')

@section('content')
<div class="card section">
<h1>Login</h1>
<form method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <label>E-mail</label>
<input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
<label>Senha</label>
<input class="form-control" type="password" name="password" required>
<label>
<input type="checkbox" name="remember"> Lembrar-me</label>
<button class="btn" type="submit">Entrar</button>
</form>
</div>
@endsection
