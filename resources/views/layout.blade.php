<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Goods CMS</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="topbar">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h2>Goods CMS</h2>
                        <span>Administration Panel</span>
                    </div>
                </div>
                @auth
                <nav>
                    <a href="{{route('home')}}"><i class="bi bi-grid"></i>Categories</a>
                    <a href="{{route('products.list')}}"><i class="bi bi-bag"></i>Goods</a>
                    <a href="{{{route('orders')}}}"><i class="bi bi-receipt"></i>Orders</a></nav>
                <a href="{{route('logout')}}" class="logout"><i class="bi bi-box-arrow-right"></i>Logout</a>
                @endauth
                @guest
                <a href="{{route('login')}}" class="login-btn">Login</a>
                @endguest
            </div>
        </div>
    </header>
    <main class="page">
        @yield('content')
    </main>
</body>

</html>
