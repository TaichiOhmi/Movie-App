<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- AlpineJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-dark text-white mt-5">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('movies.index') }}">
                    <i class="fas fa-film"></i>
                    {{ config('app.name', 'Laravel') }}
                    <i class="fas fa-film"></i>
                </a>



                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ route('movies.index') }}" class="nav-link">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tv.index') }}" class="nav-link">TV shows</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('actors.index') }}" class="nav-link">Actors</a>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @livewire('search-dropdown')
                        <!-- Authentication Links -->
                        @guest
                            <button class="btn shadow-none nav-link" id="account-dropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle nav-icon"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                {{-- Login --}}
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                                {{-- Register --}}
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        @else
                            <li class="nav-item dropdown">
                                <button class="btn shadow-none nav-link" id="account-dropdown" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        {{-- {{Auth::user()->name}} --}}
                                        <img src="#" alt="#">
                                    @else
                                        {{-- {{Auth::user()->name}} --}}
                                        <i class="fas fa-user-circle nav-icon"></i>
                                    @endif
                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- Admin Controls --}}

                                    {{-- Profile --}}
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-user-circle"></i> Profile
                                    </a>
                                    {{-- Logout --}}
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @yield('scripts')
</body>
</html>
