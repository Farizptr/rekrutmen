<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .card:hover {
            /* Removing the transform effect that causes the jiggle */
        }
        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
        }
        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
        }
        .btn-outline-primary {
            color: #4361ee;
            border-color: #4361ee;
        }
        .btn-outline-primary:hover {
            background-color: #4361ee;
            border-color: #4361ee;
        }
        .badge {
            padding: 0.5em 0.75em;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->isUser())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.lowongan*') ? 'active' : '' }}" href="{{ route('user.lowongan') }}">
                                        <i class="bi bi-briefcase me-1"></i> Job Listings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.applications') ? 'active' : '' }}" href="{{ route('user.applications') }}">
                                        <i class="bi bi-file-earmark-text me-1"></i> My Applications
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isUser())
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                                            <i class="bi bi-person me-1"></i> {{ __('My Profile') }}
                                        </a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-1"></i> {{ __('Logout') }}
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
        
        <footer class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ config('app.name', 'Laravel') }}</h5>
                        <p>Find your dream job or the perfect candidate with our recruitment platform.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            @auth
                                <li><a href="{{ route('user.lowongan') }}" class="text-white">Jobs</a></li>
                            @else
                                <li><a href="{{ route('login') }}" class="text-white">Login</a></li>
                                <li><a href="{{ route('register') }}" class="text-white">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>Contact</h5>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-envelope me-2"></i> info@example.com</li>
                            <li><i class="bi bi-telephone me-2"></i> +123 456 7890</li>
                            <li><i class="bi bi-geo-alt me-2"></i> 123 Street, City, Country</li>
                        </ul>
                    </div>
                </div>
                <hr class="bg-light">
                <div class="text-center">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 