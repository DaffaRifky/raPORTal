@extends('layout')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div><label>Email: <input type="email" name="email" value="{{ old('email') }}"></label></div>
        <div><label>Password: <input type="password" name="password"></label></div>
        <div><button type="submit">Login</button></div>
    </form>
@endsection
