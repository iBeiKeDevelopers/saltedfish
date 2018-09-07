<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}-iBuy-@yield('title')</title>

    <!-- Scripts -->
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav id="navbar-first" class="navbar navbar-expand-md navbar-light navbar-laravel">
            
            <div class="container">
                <a class="main" href="{{ url('/') }}">
                    <img id="logo" src="/storage/app/ibuy_logo.png" class="img-responsive" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div style="width:80%;margin-right:5%;">
                    @yield('form')
                </div>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link hidden-xs" href="{{ route('login') }}">登录</a></li>
                            <li><a class="nav-link hidden-xs" href="{{ route('register') }}">注册</a></li>

                            <li><a class="nav-link visible-xs" style="text-align:center;" href="{{ route('login') }}">登录</a></li>
                            <li><a class="nav-link visible-xs" style="text-align:center;" href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="nav-item dropdown">
                            
                                <a class="nav-link justify-content-center visible-xs" style="text-align:center;" href="/goods/category/all">
                                    所有商品
                                </a>
                                <a class="nav-link dropdown justify-content-center visible-xs" style="text-align:center;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>
                                    骚操作
                                </a>
                                <a class="nav-link dropdown hidden-xs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>
                                    <div style="width:50px;">
                                    <div class="circle-avatar" style="background-image:url('{{ Auth::user()->avatar ?? '/storage/null.png' }}');"></div>
                                    </div>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @yield('dropdown')
                                    <a class="dropdown-item hidden-xs" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        注销
                                    </a>
                                    <a class="dropdown-item visible-xs" style="text-align:center;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        注销
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

        @yield('navbar')

        <main class="py-4">
            @yield('content')
        </main>

        <!-- footer -->
        <footer class="container-fluid foot-wrap main-content">
            <div class="container">
                <p style="text-align:center;">&copy;&nbsp;2018&nbsp;ibeike&nbsp;team</p>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('scripts')
    
</body>
</html>
