<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ ucfirst($location) }} Schedule on {{ $date }} </title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">
    {!! HTML::style("assets/css/vendors.css") !!}
    {!! HTML::style("assets/css/app.css") !!}
    {!! HTML::style("assets/css/core/menu/menu-types/vertical-menu.css") !!}
    {!! HTML::style("assets/css/core/colors/palette-gradient.css") !!}
    {!! HTML::style("assets/css/pages/search.css") !!}
    {!! HTML::style("assets/css/style.css") !!}
</head>
<body data-open="click" data-menu="vertical-menu-modern" data-col="1-column" class="vertical-layout vertical-menu-modern 1-column   menu-expanded fixed-navbar">
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header" style="height: 80px;">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img alt="stack admin logo" src="{{ url('assets/images/logo-white.png') }}"
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
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-examples">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="card-title">{{ ucfirst($location) }} Schedule on {{ $date }}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                    <th width="20%" class="head0">Date</th>
                                    <th width="30%" class="head0">Time</th>
                                    <th width="25%" nowrap="nowrap" class="head0">Booked For</th>
                                    <th width="25%" class="head1">Details</th>
                                    </thead>
                                    <tbody>
                                    @if(isset($schedules) && count($schedules))
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{!! $schedule->date !!}</td>
                                                <td>{!! $schedule->start_time !!} to {!! $schedule->end_time !!}</td>
                                                <td>{!! $schedule->reserved_for !!}</td>
                                                <td>{!! str_limit($schedule->details,50) !!}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

{!! HTML::script('assets/vendors/js/vendors.min.js') !!}
</body>
</html>
