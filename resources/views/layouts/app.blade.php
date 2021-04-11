<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/storage/image/DDM.ico') }}" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('events.plugin')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dm-orange shadow-sm">
            <div class="container">

                <!-- Center Of Navbar -->
                <a class="navbar-brand text-white mx-auto" href="{{ route('event.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target=".navbar-collapse.right">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse right">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guard('admin')->check() == false && Auth::guard('manager')->check() == false &&
                        Auth::guard()->check() == false)
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">學生{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.login') }}">系辦{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('manager.login') }}">系學會{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @endif

                        @auth('web')
                        @include('users.dropdown')
                        @endauth

                        @auth('admin')
                        @include('admin.dropdown')
                        @endauth

                        @auth('manager')
                        @include('manager.dropdown')
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-3 mb-5">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>

</html>
