<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('node_modules/fontawesome-free/js/all.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('node_modules/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dm-orange shadow-sm">
            <div class="container">

                <!-- Center Of Navbar -->
                <a class="navbar-brand text-white mx-auto" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".navbar-collapse.right">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse right">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->realname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    @include('layouts.dropdownItem')
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-1">
            <div class="row justify-content-center">
                <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1 " href="../">最新活動</a>
                <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../系辦">系辦活動</a>
                <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../系會">系會活動</a>
                <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../校內">校內活動</a>
                <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill" href="../校外">校外活動</a>
              </div>
        </div>

        @include('events.carousel')
 
        <main class="py-5 mb-4">
            @yield('content')
        </main>
        
        @include('layouts.footer')
    </div>
</body>
</html>
