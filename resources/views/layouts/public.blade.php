<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/null.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    @notifyCss
    <style>
        .notify {
            z-index: 9999 !important;
        }
    </style>

    <title>@yield('title')</title>
</head>

<body>

<header class="navbar">
    <div class="navbar__logo">🍴</div>

    <div class="navbar__search navbar__search--desktop">
        <input type="text" placeholder="Найти ресторан, блюдо или товар">
        <button>Найти</button>
    </div>


    @if(auth()->check())
        <div class="navbar__login">
            Test
        </div>
    @else
        <div class="navbar__login">
            @if (!request()->routeIs('login.form') && !request()->routeIs('register.form'))
                <a href="{{ route('login') }}">
                    <button>
                        Войти
                    </button>
                </a>
            @endif
        </div>
    @endif
</header>

<div class="navbar__search-wrapper">
    <div class="navbar__search">
        <input type="text" placeholder="Найти ресторан">
        <button>Найти</button>
    </div>
</div>

@yield('content')
@notifyJs
@include('notify::components.notify')
</body>

</html>
