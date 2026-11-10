<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'LaravelApp') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-custom {
            background-color: #1e1e2f;
            border-bottom: 3px solid #2f80ed;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: white !important;
        }

        .navbar-custom .nav-link:hover {
            background-color: #2f80ed;
            border-radius: 5px;
        }

        .content {
            flex: 1;
            padding: 0 px
        }

        footer {
            background-color: #1e1e2f;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">LaravelApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('exams.index') }}">Exams</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.exams.create') }}">Add Exam </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.results.index') }}">results</a>
        </li>
        <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.exams.manage') }}">Manage Exams </a>  <!-- زر إدارة الامتحانات -->
                </li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.students.index') }}">students</a>
</li>

        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Log Out</button>
                        </form>
                    </li>
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @endauth
    </ul>
</div>

        </div>
    </nav>

    <!-- Page Content -->
    <main class="content container-fluid px-0 py-0">

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 LaravelApp. All rights reserved.</p>
    </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
