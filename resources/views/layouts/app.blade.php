<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore</title>
    <style>
        :root { --bg: #f4f7fb; --text: #1b2430; --primary: #0b5ed7; --card: #fff; --muted: #6b7280; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', Tahoma, sans-serif; background: linear-gradient(180deg, #eef4ff 0%, var(--bg) 40%); color: var(--text); }
        a { color: var(--primary); text-decoration: none; }
        .container { width: min(1100px, 94%); margin: 0 auto; }
        .top { background: #0f172a; color: #fff; padding: 14px 0; }
        .top .bar { display: flex; align-items: center; gap: 12px; justify-content: space-between; flex-wrap: wrap; }
        .logo { font-size: 22px; font-weight: 700; color: #fff; }
        .search { display: flex; gap: 8px; flex: 1; max-width: 460px; }
        .search input { width: 100%; padding: 10px; border-radius: 8px; border: 0; }
        .btn { border: 0; border-radius: 8px; padding: 10px 14px; background: var(--primary); color: #fff; cursor: pointer; }
        .btn.secondary { background: #334155; }
        .menu { display: flex; gap: 10px; align-items: center; }
        .card { background: var(--card); border-radius: 14px; box-shadow: 0 8px 24px rgba(0,0,0,.06); padding: 16px; }
        .grid { display: grid; gap: 16px; }
        .grid.products { grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); }
        .product-img { width: 100%; height: 160px; object-fit: cover; border-radius: 10px; background: #e2e8f0; }
        .muted { color: var(--muted); }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .hero { margin: 20px 0; padding: 36px; border-radius: 16px; color: #fff; background: linear-gradient(130deg, #0b5ed7, #06b6d4); }
        .cats { display: flex; flex-wrap: wrap; gap: 8px; }
        .pill { background: #dbeafe; color: #1e3a8a; padding: 8px 12px; border-radius: 999px; font-size: 14px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; }
        .section { margin: 20px 0; }
    </style>
</head>
<body>
<header class="top">
    <div class="container bar">
        <a class="logo" href="{{ route('home') }}">TechStore</a>
        <form class="search" action="{{ route('store.products.index') }}" method="GET">
            <input type="text" name="q" placeholder="Buscar produtos" value="{{ request('q') }}">
            <button class="btn" type="submit">Buscar</button>
        </form>
        <nav class="menu">
            <a href="{{ route('store.products.index') }}" style="color:#fff;">Catalogo</a>
            <a href="{{ route('cart.index') }}" style="color:#fff;">Carrinho</a>
            @auth
                <a href="{{ route('orders.my') }}" style="color:#fff;">Meus pedidos</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="color:#fff;">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">@csrf <button class="btn secondary" type="submit">Sair</button></form>
            @else
                <a href="{{ route('login') }}" style="color:#fff;">Login</a>
                <a href="{{ route('register') }}" style="color:#fff;">Cadastro</a>
            @endauth
        </nav>
    </div>
</header>
<main class="container" style="padding: 20px 0 40px;">
    @if($errors->any())
        <div class="card section" style="border-left: 4px solid #ef4444;">
            <strong>Erros encontrados:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="card section" style="border-left: 4px solid #10b981;">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
