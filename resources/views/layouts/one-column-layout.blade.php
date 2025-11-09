<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('page-title') {{ settings('app_name') }}</title>

    <link rel="apple-touch-icon" href="{{ url('assets/img/icons/favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="16x16" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    {!! HTML::style("assets/css/vendors.css") !!}
    {!! HTML::style("assets/vendors/css/ui/prism.min.css") !!}
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    {!! HTML::style("assets/css/app.css") !!}
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    {!! HTML::style("assets/css/core/menu/menu-types/vertical-menu-modern.css") !!}
    {!! HTML::style("assets/css/core/colors/palette-gradient.css") !!}
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    {!! HTML::style("assets/css/core/colors/palette-gradient.css") !!}
    <!-- END Custom CSS-->

    @yield('styles')
</head>
<body data-open="click" data-menu="vertical-menu-modern" data-col="1-column" class="vertical-layout vertical-menu-modern 1-column   menu-expanded fixed-navbar">
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="navbar-brand">
                        <img alt="stack admin logo" width="200" src="{{ url('assets/images/logo-white.png') }}"
                             class="brand-logo">

                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 content">
      <span class="float-md-left d-block d-md-inline-block">Strickland's Administration</span>
    </p>
</footer>
<!-- BEGIN VENDOR JS-->
{!! HTML::script('assets/vendors/js/vendors.min.js') !!}
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
{!! HTML::script('assets/vendors/js/ui/prism.min.js') !!}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN STACK JS-->
{!! HTML::script('assets/js/core/app-menu.js') !!}
{!! HTML::script('assets/js/core/app.js') !!}

@yield('scripts')
<!-- END STACK JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>
</html>
