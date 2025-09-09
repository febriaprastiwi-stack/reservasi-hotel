@extends('layouts.app')

@section('title', 'Welcome - Grand Royal Hotel')

@section('content')
    <div class="hero">
        <h1>Welcome to Grand Royal Hotel</h1>
        <p>Enjoy The Experience of Comfort & Luxury</p>
        <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
        <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
    </div>
@endsection
