@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('/images/dark-bg.png ') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        margin: 0;
        color: white;
        text-shadow: 1px 1px 3px black;
    }

    .welcome-container {
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .btn-custom {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid white;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background-color: white;
        color: black;
    }
</style>

<div class="welcome-container text-center">
    <h1 class="display-4 mb-4">🎓 مرحباً بك في منصة الامتحانات</h1>
    <a href="{{ url('/exams') }}" class="btn btn-lg btn-custom">دخول إلى الامتحانات</a>
</div>
@endsection
