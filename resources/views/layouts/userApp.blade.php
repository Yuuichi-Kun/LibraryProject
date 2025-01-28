<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FutureSight') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/special-nav.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: #1a73e8 !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #5f6368 !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #1a73e8 !important;
        }

        .profile-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .profile-section {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .section-header {
            background: #f8f9fa;
            padding: 1.25rem;
            border-bottom: 1px solid #e0e0e0;
            color: #202124;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            padding: 2rem;
        }

        .current-avatar-container {
            position: relative;
        }

        .current-avatar {
            width: 150px !important;
            height: 150px !important;
            border-radius: 50%;
            border: 4px solid #1a73e8;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .current-avatar:hover {
            transform: scale(1.05);
        }

        .upload-controls {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .btn-custom {
            background-color: #1a73e8;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #1557b0;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: none;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            color: #5f6368;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #1a73e8;
        }

        main {
            min-height: calc(100vh - 70px);
            padding: 2rem 0;
            background: linear-gradient(135deg, #f0f2f5 0%, #e3e6ec 100%);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        @media (max-width: 768px) {
            .profile-container {
                margin: 1rem;
                padding: 1rem;
            }
            
            .avatar-upload {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <i class="fas fa-arrow-left me-2"></i>
                    <span>Dashboard</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    @if(Auth::user()->avatar)
                                        <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:35px; height:35px; object-fit:cover;">
                                    @else
                                        <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:35px; height:35px; object-fit:cover;">
                                    @endif
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
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

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
