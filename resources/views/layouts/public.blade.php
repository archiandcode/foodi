<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodPark')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @notifyCss
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        .notify {
        z-index: 10000;
        }

        .notify p:first-child {
        margin-bottom: 0 !important;
        }

        .notify p:last-child {
        margin-top: 5px;
        margin-bottom: 0 !important;
        }

        .notify .p-4 {
        padding: 15px !important;
        }

        .notify .ml-4 {
        margin-left: 0.7rem !important;
        }

        .inset-0 {
        top: 41px;
        }

    </style>
</head>
<body id="app">

<navbar
    login-route="{{ route('login.form') }}"
    :is-logged-in="@json(auth()->check())"
    :csrf-token="'{{ csrf_token() }}'"
    :on-auth-page="@json(request()->routeIs('login.form') || request()->routeIs('register.form'))"
></navbar>

@include('notify::components.notify')

@yield('content')

@include('notify::components.notify')
@notifyJs
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@vite(['resources/js/app.js'])
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifyElement = document.querySelector('.notify');

        if (notifyElement) {
            setTimeout(function () {
                notifyElement.style.display = 'none';
            }, 2500);

            const closeButton = notifyElement.querySelector('button');

            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    notifyElement.style.display = 'none';
                });
            }
        }
    });
</script>

</body>
</html>
