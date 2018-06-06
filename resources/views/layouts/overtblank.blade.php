<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/crm-icon.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta xttp-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>overt | intelligence</title>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/crm/css/material-dashboard.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/crm/css/jquery.auto-complete.css') }}" rel="stylesheet"/>
    @yield('css')
</head>

<body class="sidebar-mini off-canvas-sidebar login-page">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-transparent navbar-absolute" color-on-scroll="500">
        <div class="container">
        <div class="navbar-wrapper">
          
                        <a href="{{ route('bam.dashboard') }}" class="simple-text logo-mini"><!--[if gte IE 9]><!-->
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
              <a class="navbar-brand" href="">overt | Intelligence</a>
                    
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
        </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                        <a href="{{ route('bam.dashboard') }}" class="nav-link">
                            <i class="material-icons">dashboard</i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="material-icons">person_add</i>
                            {{ __('Registrar') }}
                        </a>
                    </li>
                    <li class="nav-item  active ">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="material-icons">fingerprint</i>
                            {{ __('Login') }}
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="material-icons">lock_open</i>
                            Lock
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="black" style="background-image: url({{ url('assets/crm/img/sidebar-1.jpg') }}); background-size: cover; background-position: top center;">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->

            <div class="container">
                <div class="content" style="margin-top: 10px;">
                    @yield('content')
                </div>
                    <footer class="wizard-footer">
                        <div class="container text-right">
                        </div>
                    </footer>
                 </div>
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
@yield('js')  