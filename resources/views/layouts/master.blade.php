<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light navbar-fixed-top" style="background-color: #e3f2fd;">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index')}}">Online Shop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')><a href="{{ route('index')}}">Все товары</a></li>
                <li @routeactive('categor*')><a href="{{ route('categories')}}">Категории</a>
                </li>
                <li @routeactive('basket*')><a href="{{ route('basket')}}">В корзину</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login')}}">Войти</a></li>
                @endguest

                @auth
                    @admin
                        <li><a href="{{ route('home')}}">Панель администратора</a></li>
                    @else
                        <li><a href="{{ route('person.orders.index')}}">Мои заказы</a></li>
                    @endadmin
                    <li><a href="{{ route('get-logout')}}">Выйти</a></li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        @if(session()->has('error'))
            <p class="alert alert-danger">{{ session()->get('error') }}</p>
        @endif
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
