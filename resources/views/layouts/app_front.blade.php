<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Alan Simons')}}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Loved+by+the+King" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/self-made.css') }}">
</head>
<body>
<div id="app">
    <nav class="menu">
        <div class="container">
            <a class="menu-logo" href="{{ url('/') }}">
                {{ config('app.name', 'Alan Simons') }}
            </a>
            <button class="menu-btn" style="display: none" type="button" data-toggle="collapse" data-target="#menu-block" aria-controls="menu-block" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="nav-menu" id="menu-block">
                <li class="nav-menu-item"><a class="nav-menu-link" href="/">Main</a></li>
                <li class="nav-menu-item"><a class="nav-menu-link" href="/posts">Posts</a></li>
                <li class="nav-menu-item"><a class="nav-menu-link" href="/projects">Projects</a></li>
                <li class="nav-menu-item"><a class="nav-menu-link" href="/about">About </a></li>
            </ul>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>