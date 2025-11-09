<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') | {{ settings('app_name') }}</title>


    <link rel="apple-touch-icon" href="{{ url('assets/img/icons/favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="16x16" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">



    {!! HTML::style("assets/css/vendors.css") !!}
    {!! HTML::style("assets/vendors/css/forms/icheck/icheck.css") !!}
    {!! HTML::style("assets/vendors/css/forms/icheck/custom.css") !!}
    {!! HTML::style("assets/css/app.css") !!}
    {!! HTML::style("assets/css/pages/login-register.css") !!}
    {!! HTML::style("assets/css/style.css") !!}





    @yield('header-scripts')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page">

<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
            @yield('content')
            </section>
        </div>
    </div>
</div>

    {!! HTML::script('assets/js/jquery-2.1.4.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}
    {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    {!! HTML::script('assets/js/as/app.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}

    @yield('scripts')
</body>
</html>
