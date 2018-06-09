<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/crm-icon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>overt | intelligence, tecnologia para transformação digital!</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/gaia.css" rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Cambo|Poppins:400,600' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/fonts/pe-icon-7-stroke.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-transparent navbar-fixed-top" color-on-scroll="200">
        <div class="container">
            <div class="navbar-header">
                <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="">overt | intelligence</a> 
                </div>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right navbar-uppercase">
                    @guest
                    <li><a class="btn btn-danger btn-fill" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                    <li><a class="btn btn-danger btn-fill" href="{{ route('register') }}">{{ __('Registrar') }}</a></li>
                    @else
                    <li>
                        <a href="{{ route('BAM') }}" class="btn btn-danger btn-fill">BAM</a>
                    </li>

                    <li class="dropdown">
                        <a id="navbarDropdown" href="#" class="btn btn-danger btn-fill dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu  dropdown-danger">
                            <li>
                                <a href="#"><i class=""></i> Perfil</a>
                            </li>
                            <li>
                                <a class="" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>   
    @yield('content')
    <footer class="footer footer-big footer-color-black" data-color="black">
        <div class="container">
            <div class="row">
                <hr>
                <div class="copyright">
                     © <script> document.write(new Date().getFullYear()) </script> overt | intelligence, for challenger business
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.js') }}"></script>
<script src="{{ asset('assets/js/gaia.js') }}"></script>
</html>
