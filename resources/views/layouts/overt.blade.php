<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/crm-icon.png') }}" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <meta xttp-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>overt | challenger business</title>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
        <link href="{{ asset('assets/crm/css/material-dashboard.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/crm/css/jquery.auto-complete.css') }}" rel="stylesheet"/>
        @yield('css')
    </head>
    <body class="sidebar-mini">
        <div class="wrapper">
            <div class="sidebar" data-color="azure" data-background-color="black" data-image="{{ url('assets/crm/img/sidebar-1.jpg') }}">
                <div class="logo">
                    <a href="#" class="simple-text logo-mini"><!--[if gte IE 9]><!-->
                        <!--?xml version="1.0" encoding="UTF-8"?-->
                        <!-- Creator: CorelDRAW X6 -->
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="7.500mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 1104 1122" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <style type="text/css"><![CDATA[
                                    .fil0 {fill:#EB3D00;fill-rule:nonzero}
                                    .fil1 {fill:#EFC415;fill-rule:nonzero}
                                    .fil2 {fill:#F38001;fill-rule:nonzero}
                                    ]]>
                                </style>
                            </defs>
                            <g id="Camada_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0" d="M59 234l0 -68 441 -166 0 73 -349 128 349 129 0 73 -441 -169zm986 0l-441 169 0 -73 348 -129 -348 -128 0 -73 441 166 0 68z"></path>
                                <path class="fil1" d="M611 1122l-59 -34 76 -465 63 37 -64 366 287 -238 63 37 -366 297zm493 -854l-74 466 -63 -37 62 -366 -285 238 -63 -37 364 -299 59 34z"></path>
                                <path class="fil2" d="M493 1122l59 -34 -76 -465 -63 37 64 366 -287 -238 -63 37 366 297zm-493 -854l74 466 63 -37 -62 -366 285 238 63 -37 -364 -299 -59 34z"></path>
                            </g>
                            </svg>
                            <!--<![endif]-->
                            <!--[if lt IE 9]>
                            <img src="http://localhost:82/nfi/public/img/overt.png" alt="overt">
                            <![endif]--></a>
                    <a href="#" class="simple-text logo-normal">{{Session::get('module')}}</a>
                </div>
                <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y">
                    <ul class="nav">
                        @yield('overtsidebar')
                    </ul>
                </div>
            </div>
            <div class="main-panel ps-container ps-theme-default">
                <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div  class="navbar-minimize">
                                <button id="minimizeSidebar" class="btn btn-link btn-sm btn-fab btn-round">
                                    <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                                    <i class="material-icons visible-on-sidebar-mini">view_list</i>
                                </button>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(Session()->has('NomFta'))
                                        <span class="notification" style="background-color: transparent; border: none;">

                                            <small id="UsuEmp" class="text-muted">{{ Session()->get('NomFta') }}</small>
                                        </span>
                                        @endif
                                        <i class="material-icons">person</i>
                                        {{ Auth::user()->name }}<br>
                                    </a>
                                    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        @if(!Session()->has('NomFta'))
                                        <a class="dropdown-item" href="{{route('reg.empresas')}}"><i class="material-icons"></i>Registrar uma Empresa</a>
                                        @endif
                                        <a class="dropdown-item" href="{{route('reg.empresas')}}"><i class="material-icons"></i>Entidade/Empresa</a>
                                        <a class="dropdown-item" href="{{route('senior.v070emp')}}"><i class="material-icons"></i>Unidade/Filiais</a>
                                        <a class="dropdown-item" href="{{route('reg.usuarios')}}"><i class="material-icons"></i>Usuários</a>
                                        <a class="dropdown-item" href="{{ url('') }}">Home
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content" style="margin-top: 15px;">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="container">
                        <div class="copyright pull-right">
                            <span class="notification" style="background-color: transparent; border: none;">
                                 <small class="text-muted">
                                     &copy;
                                    <script>
                                    document.write(new Date().getFullYear());
                                    </script> <a class="text-info" href="http://www.overt.com.br">overt</a>
                                     | for challenger business
                                 </small>
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
<script src="{{ asset('assets/crm/js/jquery.min.js') }}"></script>   
<script src="{{ asset('assets/crm/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/bootstrap-material-design.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/bootstrap-selectpicker.js') }}"></script>
<script src="{{ asset('assets/crm/js/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/crm/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/modernizr.js') }}"></script>
<script src="{{ asset('assets/crm/js/material-dashboard.js') }}"></script>
<script src="{{ asset('assets/crm/js/core.js') }}"></script>
<script src="{{ asset('assets/crm/js/arrive.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('assets/crm/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery-jvectormap.js') }}"></script>
<script src="{{ asset('assets/crm/js/nouislider.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.select-bootstrap.js') }}"></script>
<script src="{{ asset('assets/crm/js/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/crm/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/pt-br.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.bootstrap.js') }}"></script>
<script src="{{ asset('assets/crm/js/material-bootstrap-wizard.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.autocomplete.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/overt.funcoes.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/numeral.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/numeralpt-br.min.js') }}"></script>
<script src="{{ asset('assets/crm/js/jquery.tmpl.min.js') }}"></script>
@yield('js')  