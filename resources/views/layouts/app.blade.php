<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --text: #1b2430;
            --primary: #0b5ed7;
            --card: #fff;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(180deg, #eef4ff 0%, var(--bg) 40%);
            color: var(--text);
        }

        a {
            color: var(--primary);
            text-decoration: none;
        }

        .container {
            width: min(1100px, 94%);
            margin: 0 auto;
        }

        .top {
            background: #0f172a;
            color: #fff;
            padding: 10px 0;
        }

        .top .bar {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-image {
            display: block;
            width: 130px;
            height: 58px;
            object-fit: cover;
            object-position: center;
        }

        .search {
            display: flex;
            gap: 8px;
            flex: 1;
            max-width: 460px;
        }

        .search input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 0;
        }

        .btn {
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            background: var(--primary);
            color: #fff;
            cursor: pointer;
        }
        .form-control + .btn {
            margin-top: 10px;
        }

        .btn.secondary {
            background: #276fd3;
        }
        .btn-edit {
            background: #80EF80;
            color: #0d3b0d;
            font-weight: 600;
        }
        .btn-edit:hover {
            background: #6fe26f;
            color: #0a2f0a;
        }
        .btn-delete {
            background: #FF2C2C;
            color: #fff;
            font-weight: 600;
        }
        .btn-delete:hover {
            background: #a30f0f;
        }
        .menu .btn.btn-delete:hover {
            background: #a30f0f;
        }
        .btn:hover {
            background: #0d347e;
        }

        .menu {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .menu a {
            color: #fff;
            font-weight: 500;
            line-height: 1;
        }
        .menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid transparent;
            background: #0f172a;
            color: #fff;
            font-weight: 600;
            transition: background .2s ease, border-color .2s ease;
        }
        .menu-btn:hover {
            background: rgba(255, 255, 255, .10);
            border-color: transparent;
        }

        .menu form {
            margin: 0;
            display: inline-flex;
            align-items: center;
        }

        .menu .btn {
            padding: 8px 14px;
            min-height: 34px;
            line-height: 1;
            font-weight: 600;
        }
        .action-buttons {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .action-buttons form {
            margin: 0;
        }

        .card {
            background: var(--card);
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            padding: 16px;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid.products {
            grid-template-columns: repeat(auto-fill, minmax(240px, 320px));
        }

        .grid.featured-products {
            grid-template-columns: repeat(auto-fill, minmax(240px, 320px));
        }

        .product-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            background: #e2e8f0;
            transition: transform .28s ease;
        }
        .product-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
        }
        .product-card::before {
            content: "";
            position: absolute;
            inset: -40%;
            background: radial-gradient(circle, rgba(11, 94, 215, .20) 0%, rgba(11, 94, 215, 0) 60%);
            opacity: 0;
            transition: opacity .28s ease;
            pointer-events: none;
        }
        .product-card:hover,
        .product-card:focus-within {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 18px 34px rgba(11, 94, 215, .22);
            border-color: rgba(11, 94, 215, .35);
        }
        .product-card:hover::before,
        .product-card:focus-within::before {
            opacity: 1;
        }
        .product-card:hover .product-img,
        .product-card:focus-within .product-img {
            transform: scale(1.05);
        }

        .product-detail-image-wrap {
            width: min(520px, 100%);
            height: 360px;
            margin: 14px 0 18px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f8fafc;
            display: grid;
            place-items: center;
            overflow: hidden;
            padding: 12px;
        }
        .product-gallery {
            position: relative;
            width: min(520px, 100%);
            margin: 14px 0 18px;
            margin-left: auto;
            margin-right: auto;
        }

        .product-detail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 8px;
            transition: transform .28s ease, box-shadow .28s ease, filter .28s ease;
        }
        .product-gallery:hover .product-detail-image {
            transform: scale(1.03);
            box-shadow: 0 18px 30px rgba(11, 94, 215, .25);
            filter: brightness(1.03);
        }
        .gallery-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: rgba(15, 23, 42, .75);
            color: #fff;
            cursor: pointer;
            font-size: 20px;
            line-height: 1;
            display: grid;
            place-items: center;
        }
        .gallery-btn.prev {
            left: 10px;
        }
        .gallery-btn.next {
            right: 10px;
        }
        .gallery-btn:hover {
            background: rgba(11, 94, 215, .9);
        }
        .thumbs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 8px;
            justify-content: center;
        }
        .thumbs img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .thumbs img:hover {
            transform: scale(1.08);
            box-shadow: 0 10px 20px rgba(0,0,0,.2);
        }

        .muted {
            color: var(--muted);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .hero {
            margin: 20px 0;
            padding: 36px;
            border-radius: 16px;
            color: #fff;
            background: linear-gradient(130deg, #0b5ed7, #06b6d4);
        }

        .cats {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pill {
            background: #dbeafe;
            color: #1e3a8a;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        .section {
            margin: 20px 0;
        }
        .review-summary {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }
        .stars {
            color: #f59e0b;
            letter-spacing: 2px;
            font-size: 18px;
            line-height: 1;
        }
        .review-item {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            background: #fff;
            margin-bottom: 10px;
        }
        .review-item p {
            margin: 6px 0;
        }

        @media (max-width: 768px) {
            .top .bar {
                justify-content: center;
            }

            .logo-image {
                width: 108px;
                height: 50px;
            }

            .menu {
                justify-content: center;
            }

            .product-img {
                height: 170px;
            }

            .grid.products {
                grid-template-columns: 1fr;
            }

            .grid.featured-products {
                grid-template-columns: 1fr;
            }

            .product-detail-image-wrap {
                width: 100%;
                height: 280px;
            }

            .product-detail-image {
                height: 100%;
            }
        }
        @media (hover: none) {
            .product-card:hover,
            .product-card:focus-within {
                transform: none;
            }
            .product-card:hover .product-img,
            .product-card:focus-within .product-img {
                transform: none;
            }
            .product-card:hover::before,
            .product-card:focus-within::before {
                opacity: 0;
            }
            .product-gallery:hover .product-detail-image {
                transform: none;
                box-shadow: none;
                filter: none;
            }
        }
    </style>
</head>

<body>
    <header class="top">
        <div class="container bar">
            <a class="logo" href="{{ route('home') }}">
                <img class="logo-image" src="{{ asset('images/techstore-logo.png') }}" alt="TechStore">
            </a>
            <form class="search" action="{{ route('store.products.index') }}" method="GET">
                <input type="text" name="q" placeholder="Buscar produtos" value="{{ request('q') }}">
                <button class="btn" type="submit">Buscar</button>
            </form>
            <nav class="menu">
                <a class="menu-btn" href="{{ route('store.products.index') }}" style="color:#fff;">Catálogo</a>
                <a class="menu-btn" href="{{ route('cart.index') }}" style="color:#fff;">Carrinho</a>
                @auth
                <a class="menu-btn" href="{{ route('orders.my') }}" style="color:#fff;">Meus pedidos</a>
                @if(auth()->user()->role === 'admin')
                <a class="menu-btn" href="{{ route('admin.dashboard') }}" style="color:#fff;">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">@csrf <button class="btn btn-delete" type="submit">Sair</button>
                </form>
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
