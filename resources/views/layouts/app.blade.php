<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | {{ settings('app_name') }}</title>

    <link rel="apple-touch-icon" href="{{ url('assets/img/icons/favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon.ico') }}" sizes="16x16" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- BEGIN Custom CSS-->
    {!! HTML::style("assets/css/vendors.css") !!}
    {!! HTML::style("assets/vendors/css/forms/icheck/icheck.css") !!}
    {!! HTML::style("assets/vendors/css/forms/icheck/custom.css") !!}

    @stack('vendor-css')

    {!! HTML::style("assets/css/app.css") !!}
    {!! HTML::style("assets/css/pages/login-register.css") !!}
    {{--{!! HTML::style("assets/css/style.css") !!}--}}
    {!! HTML::style("assets/vendors/css/extensions/unslider.css") !!}
    {!! HTML::style("assets/vendors/css/weather-icons/climacons.min.css") !!}
    {!! HTML::style("assets/fonts/meteocons/style.css") !!}
    {!! HTML::style("assets/vendors/css/charts/morris.css") !!}
    {!! HTML::style("assets/css/core/menu/menu-types/vertical-menu.css") !!}
    {!! HTML::style("assets/fonts/simple-line-icons/style.css") !!}
    {!! HTML::style("assets/css/core/colors/palette-gradient.css") !!}
    {!! HTML::style("assets/css/pages/timeline.css") !!}
    {!! HTML::style("assets/vendors/css/forms/selects/select2.min.css") !!}
    {!! HTML::style("assets//vendors/css/extensions/toastr.css") !!}
    {!! HTML::style('assets/css/sweetalert.css') !!}
    {!! HTML::style('assets/vendors/css/tables/datatable/datatables.min.css') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    @yield('styles')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">

    @include('partials.nav')
    @include('partials.sidebar')

    <div class="app-content content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script> var base_url = '{{ url('/') }}';</script>
    @yield('top-scripts')



    {{-- For production, it is recommended to combine following scripts into one. --}}

    {!! HTML::script('assets/vendors/js/vendors.min.js') !!}
    {!! HTML::script('assets/vendors/js/extensions/unslider-min.js') !!}
    {!! HTML::script('assets/vendors/js/timeline/horizontal-timeline.js') !!}
    {!! HTML::script('assets/plugins/js-cookie/js.cookie.js') !!}


    @stack('page-vendor-js')

    {!! HTML::script('assets/vendors/js/forms/select/select2.full.min.js') !!}
    {!! HTML::script('assets/js/scripts/forms/select/form-select2.js') !!}
    {!! HTML::script('assets/vendors/js/extensions/sweetalert.min.js') !!}
    {!! HTML::script('assets/vendors/js/extensions/toastr.min.js') !!}
    {!! HTML::script('assets/js/delete.handler.js') !!}
    @if(request()->path() == "delivery-schedule/add")
        
    @else
        {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    @endif
    {!! HTML::script('assets/vendors/js/tables/datatable/datatables.min.js') !!}
    {!! HTML::script('assets/js/scripts/tables/datatables/datatable-basic.js') !!}

    {{-- Page Level JS --}}
    {!! HTML::script('assets/js/core/app-menu.js') !!}
    {!! HTML::script('assets/js/core/app.js') !!}
    {{ HTML::script('assets/js/pages/comman.js') }}

    @stack('page-js')

    @yield('scripts')
</body>
</html>
