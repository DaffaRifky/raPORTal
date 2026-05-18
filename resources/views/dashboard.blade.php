@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p>Welcome, <strong>{{ $user->name }}</strong></p>
    <p>Your email: {{ $user->email }}</p>
@endsection
