<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.12/dist/cdn.min.js"></script>
    <title>{{ config('app.name', 'raPORTal') }} — @yield('title')</title>
</head>
<body x-data="{ sidebarOpen: false }">
    <x-sidebar />
    <x-header>@yield('header')</x-header>

    <!-- backdrop for mobile -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        style="display: none;"
    ></div>

    <div class="lg:ml-56 mt-15 p-8 ">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
