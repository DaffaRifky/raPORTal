@extends('layout')

@section('title', 'Home')

@section('content')
    <h1>Welcome to the App</h1>
    @if($user)
        <p>Signed in as <strong>{{ $user->name }}</strong> ({{ $user->email }})</p>
        <p><a href="{{ route('dashboard') }}">Go to dashboard</a></p>
    @else
        <p>Please <a href="{{ route('login.show') }}">login</a> or <a href="{{ route('register.show') }}">register</a>.</p>
    @endif
@endsection
