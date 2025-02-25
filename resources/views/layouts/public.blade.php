<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodPark')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>
<body id="app">

<navbar
    login-route="{{ route('login.form') }}"
    :is-logged-in="@json(auth()->check())"
    :csrf-token="'{{ csrf_token() }}'"
    :on-auth-page="@json(request()->routeIs('login.form') || request()->routeIs('register.form'))"
></navbar>


@yield('content')


@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@vite(['resources/js/app.js'])

</body>


</html>
