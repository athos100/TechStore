@extends('layouts.app')

@section('content')
<h1>Usuarios (Admin)</h1>
<div class="card section">
    <table>
        <tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Perfil</th></tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
        @endforeach
    </table>
    <div class="section">{{ $users->links() }}</div>
</div>
@endsection
