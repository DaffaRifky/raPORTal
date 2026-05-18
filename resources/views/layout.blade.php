<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'App')</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <nav style="padding:10px;border-bottom:1px solid #ddd;">
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        @if(session('user_id'))
            <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf <button type="submit">Logout</button></form>
        @else
            <a href="{{ route('login.show') }}">Login</a> |
            <a href="{{ route('register.show') }}">Register</a>
        @endif
    </nav>

    <main style="padding:20px">@yield('content')</main>
</body>
</html>
