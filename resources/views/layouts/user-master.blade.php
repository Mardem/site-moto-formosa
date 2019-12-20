<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Eder Tattoo') &mdash; {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <!-- CSS Libraries -->

    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="{{ asset('icons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#000000">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
    @stack('css')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg{{ Auth::user()->unreadNotifications->count() ? ' beep' : '' }}"><i class="far fa-bell"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notificações
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <p class="text-muted p-2 text-center">Nenhuma notificação foi encontrada!</p>
                        </div>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ Auth::user()->avatarlink }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Olá, {{ Auth::user()->name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Bem-vindo, {{ Auth::user()->name }}</div>
                        <a href="{{ Auth::user()->profilelink }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>

        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html">MF</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li class=""><a class="nav-link" href="{{ route('user-login') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>

                    <li class="menu-header">Endereços</li>
                    <li class="{{ currentActiveMenu('admin/control/clients*') }}"><a class="nav-link" href="{{ route('address.index') }}"><i class="fa fa-circle"></i> <span>Meus endereços</span></a></li>

                </ul>
            </aside>

        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('admin.partials.footer')
        </footer>
    </div>
</div>

<script src="{{ route('js.dynamic') }}"></script>
<script src="{{ asset('js/app.js') }}?{{ uniqid() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@stack('js')
@yield('scripts')
</body>
</html>
