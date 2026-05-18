@extends('layout')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div><label>Name: <input type="text" name="name" value="{{ old('name') }}"></label></div>
        <div><label>Email: <input type="email" name="email" value="{{ old('email') }}"></label></div>
        <div><label>Password: <input type="password" name="password"></label></div>
        <div><label>Confirm Password: <input type="password" name="password_confirmation"></label></div>
        <div><button type="submit">Register</button></div>
    </form>
@endsection
