<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'raPORTal') }} — @yield('title')</title>
</head>
<body >
 <x-sidebar />
 <x-header>@yield('header')</x-header>
    <div class="ml-56 p-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
