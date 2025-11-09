@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')

    <style>
        @media (max-width:1920px) {
            .myContent {
                display:none;
            }
        }
    </style>
    <div class="content-header row mb-1">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Strickland's Admin Dashboard</h3>
        </div>
        @if(Gate::allows('only-admin'))
            <div class="content-header-right col-md-6 col-12">
                <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                    <a href="{!! route('news-update.create') !!}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Dashboard News</a>
                </div>
            </div>
        @endif
    </div>

    <div class="content-body">
        <!-- Stats -->
        <div class="row myContent">
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ New Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-success p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>New Vehicles</h4>
                                <span>
                                            Status Code = N
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    {{ $vehicles->where('fldStatusCode','N')->wherein('fldLocationCode',['BG','G','W','E','T','BR','DL'])->count() }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End New Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Used Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-info bg-darken-3 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Used Vehicles</h4>
                                <span>
                                            Status Code = U
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    {{ $vehicles->where('fldStatusCode','U')->wherein('fldLocationCode',['BG','G','W','E','T','BR','DL'])->where('fldKey1','<>','P')->count() }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Used Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ IT Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-info bg-lighten-1 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>In Transit</h4>
                                <span>
                                            Lot Code = IT
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    {{ $vehicles->where('fldLocationCode','IT')->count() }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End IT Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Wholsale Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-info bg-lighten-1 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Wholesale</h4>
                                <span>
                                            Lot Code = A
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    {{ $vehicles->where('fldCode','A')->where('fldKey1','<>','P')->count() + $vehicles->where('fldLocationCode','A')->count() -  $vehicles->where('fldLocationCode','A')->where('fldCode','A')->where('fldKey1','<>','P')->count() }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Stat Wholsale Card -->
            </div>
        </div>
        <!--/ Stats -->
       <div class="row">
            <div class="col-md-6">
                @foreach($newsUpdate as $news)
                    @continue($news->id == 15)
                    @include('dashboard.news-update',['deleteOption'=>true])
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">

                            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" id="store-performance-link" data-toggle="tab" href="#store-performance-tab" aria-controls="store-performance-tab" aria-expanded="false">Store Performance</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="daily-sales-link" data-toggle="tab" href="#daily-sales-tab" aria-controls="daily-sales-tab" aria-expanded="false">Daily Sales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sales-rank-link" data-toggle="tab" href="#sales-rank-tab" role="button" aria-controls="sales-rank-tab">Sales Rank</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="iamges-link" data-toggle="tab" href="#iamges-tab" aria-controls="iamges-tab" aria-expanded="true">Images</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active" id="store-performance-tab" role="tabpanel" aria-labelledby="store-performance-tab" aria-expanded="false">
                                    <table class="table table-responsive table-hover table-border" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="35%">Store</th>
                                            <th width="65%">Target</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stats as $stat)
                                            @php
                                                $percentage   = $stat['percent'];
                                                $ffpercentage = $stat['ffpercent'];
                                            @endphp
                                            <tr>
                                                <th>
                                                    <a href="{{ route('sales-tracking',$stat['id']) }}">{{ $stat['title'] }}</a>
                                                </th>
                                                <th>
                                                    <div style="margin-bottom: 15px;">
                                                        <div style="display: inline-block;width: 40px;">{{ $stat['title_ff'] }}</div>
                                                        <div class="progress" style="margin-bottom:0px; display: inline-block; width: 80%;">
                                                            <div class="progress-bar {{ ($ffpercentage < 95) ? (($ffpercentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($ffpercentage,0) }}" aria-valuemin="{{ round($ffpercentage,0) }}" aria-valuemax="100" style="width:{{ round($ffpercentage,0) }}%; max-width: 100%">{{ round($ffpercentage,0) }}%</div>
                                                        </div>
                                                        <div style="display: inline-block">
                                                            {{ round($ffpercentage) }} %
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div style="display: inline-block;width: 40px;">Used</div>
                                                        <div class="progress" style="margin-bottom:0px; display: inline-block;width: 80%;">
                                                            <div class="progress-bar {{ ($percentage < 95) ? (($percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($percentage,0) }}" aria-valuemin="{{ round($percentage,0) }}" aria-valuemax="100" style="width:{{ round($percentage,0) }}%; max-width: 100%">{{ round($percentage,0) }}%</div>
                                                        </div>
                                                        <div style="display: inline-block">
                                                            {{ round($percentage) }} %
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="daily-sales-tab" aria-labelledby="daily-sales-tab" aria-expanded="false">
                                    <div class="card-header m-0 p-0">
                                        <h4 class="card-title px-0 py-0 mb-2">DAILY SALES LIST - <a href="{{ route('daily-sales') }}">View Detailed List</a></h4>
                                    </div>
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Date</span>
                                                    <input type="text" class="form-control pickadate" style="cursor: pointer !important;" name="date" value="{{ request('date',date('Y-m-d')) }}" placeholder="Date">
                                                    <button class="input-group-addon btn btn-primary" type="submit" style="color: #ffffff"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h2 class="my-2 text-center">Sales on {{ request('date',date('Y-m-d')) }}</h2>
                                                @if(!empty($dailySales) && $dailySales->count())

                                                    <table class="table table-hover table-bordered text-center">
                                                        <thead>
                                                        <tr>
                                                            <td>Location</td>
                                                            <td>Y/M/KM</td>
                                                            <td>Stock</td>
                                                            <td>Trade</td>
                                                            <td>Sold By</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($dailySales as $sale)
                                                            <tr>
                                                                <td>{{ $locations->get($sale->fld_location)->fldLocationName }}</td>
                                                                <td>{!! $sale->fld_year . "<br/>" . $sale->fld_model . "<br>" !!} @if($sale->vehicle) <br> {!! $sale->vehicle->fldOdometer !!} @endif</td>
                                                                <td>{{ $sale->fld_stock }} @if($sale->vehicle) <br> {{ $sale->vehicle->stock_days }} days @endif</td>
                                                                <td>{{ $sale->trade }}</td>
                                                                <td>{{ $sale->saleperson->full_name }}&nbsp;&nbsp;@if($sale->saleperson2) {{ $sale->saleperson2->full_name }}  @endif</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No records found</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="sales-rank-tab" role="tabpanel" aria-labelledby="sales-rank-tab" aria-expanded="false">
                                    <div class="card-header m-0 p-0">
                                        <h4 style="text-transform:initial; text-align: center" class="card-title px-0 py-0 mb-2">TOP 15 SALES RANK FOR THE MONTH - <a href="{{ route('sales-ranking') }}">VIEW FULL LIST</a></h4>
                                    </div>
                                    <table class="table-bordered table-hover table text-center">
                                        <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Funded</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($salesman as $saler)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $saler->full_name }}</td>
                                                <td>{{ $locations->get($saler->fld_usr_location)->fldLocationName }}</td>
                                                <td>{{ $saler->rank }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane " id="iamges-tab" role="tabpanel" aria-labelledby="iamges-tab" aria-expanded="true">
                                    <div class="card-header m-0 p-0">
                                        <h4 style="text-transform:initial; text-align: center" class="card-title px-0 py-0 mb-2">Stricklands - {{ $imageStatics['all_without'] }} Without - {{ $imageStatics['total'] }} Total, {{ $imageStatics['percent'] }}%</h4>
                                    </div>
                                    <div id="stricklands-chart" data-text="testing" class="height-400 echart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($newsUpdate->where('id',15) as $news)
                    @include('dashboard.news-update',['deleteOption'=>false])
                @endforeach

            </div>
        </div>

    <div class="invisible" style="display: none;">
        <div class="content-header-left">
            <h3 class="content-header-title mb-20">Sales Statistics</h3>
        </div>
        <!-- Stats -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Decoded Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-teal p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>New Sales</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Last 24 Hours
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    18*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Used Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ New Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-amber p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Used Sales</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Last 24 Hours
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    6*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End New Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ IT Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-blue-grey bg-darken-3 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Funded</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    7*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End IT Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Wholsale Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-purple bg-accent-4 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Delivered</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    11*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Stat Wholsale Card -->
            </div>
        </div>
        <!--/ Stats -->
        <!-- Stats -->
        <div class="content-header-left">
            <h3 class="content-header-title mb-20">Image Statistics</h3>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Decoded Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-success p-2 media-middle">
                                <i class="fa fa-picture-o font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>SAM Images</h4>
                                <span>With Image
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    78%*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Used Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ New Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-amber p-2 media-middle">
                                <i class="fa fa-picture-o font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>BGM Images</h4>
                                <span>With Image
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    76%*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End New Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ IT Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-blue-grey bg-darken-3 p-2 media-middle">
                                <i class="fa fa-picture-o font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>BAM Images</h4>
                                <span>With Image
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    57%*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End IT Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Wholsale Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-red bg-accent-2 bg-accent-4 p-2 media-middle">
                                <i class="fa fa-picture-o font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>WAM</h4>
                                <span>With Image
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    68%*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Stat Wholsale Card -->
            </div>
        </div>
        <!--/ Stats -->
        <div class="content-header-left">
            <h3 class="content-header-title mb-20">Logistics Statistics</h3>
        </div>
        <!-- Stats -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Decoded Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-teal p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Vehicles Decoded</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Last 24 Hours
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    18*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Used Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ New Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-amber p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Vehicles Pictured</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Last 24 Hours
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    6*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End New Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ IT Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-blue-grey bg-darken-3 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>Certified</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    7*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End IT Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Wholsale Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-purple bg-accent-4 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>E-Tested</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    11*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Stat Wholsale Card -->
            </div>
        </div>
        <!--/ Stats -->
        <div class="content-header-left">
            <h3 class="content-header-title mb-20">Trade In Statistics</h3>
        </div>
        <!-- Stats -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Decoded Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-teal p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>SAM Trades</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    3*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Used Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ New Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-amber p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>GM Trades</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    16*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End New Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ IT Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-blue-grey bg-darken-3 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>BGM Trades</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    7*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End IT Stat Card  -->
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <!--/ Wholsale Stat Card  -->
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="bg-purple bg-accent-4 p-2 media-middle">
                                <i class="fa fa-car font-large-2 white"></i>
                            </div>
                            <div class="media-body p-2">
                                <h4>WAM Trades</h4>
                                <span><i class="ft-arrow-up"></i>
                                            Sept 03 - Sept 29
                                        </span>
                            </div>
                            <div class="media-right p-2 media-middle">
                                <h1 class="primary">
                                    5*
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Stat Wholsale Card -->
            </div>
        </div>
        <!--/ Stats -->

    </div>
    </div>
    <form name="delete_form" id="delete-form" action="{!! route('news-update.delete') !!}" method="post">
        <input type="hidden" name="id" >
        {!! csrf_field() !!}
    </form>

    <style>
        .card .heading-elements{ display: none; }
        .card:hover .heading-elements{ display: block; }
    </style>
@stop

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/pickers/pickadate/pickadate.css') !!}
@endpush

@section('scripts')
    {!! HTML::script('assets/vendors/js/charts/echarts/echarts.js') !!}
    <script>
        $(window).on("load", function(){
            require.config({
                paths: {
                    echarts: base_url+'/assets/vendors/js/charts/echarts'
                }
            });
            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],

                // Charts setup
                function (ec) {

                    var chart = ec.init(document.getElementById('stricklands-chart'));
                    var chartOptions = {
                        title: {
                            text: 'Stricklands Photo Count',
                            //subtext: 'Open source information',
                            x: 'center'
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: "{b}: {c} ({d}%)"
                        },

                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['Photos', 'No Photos']
                        },
                        color: ['{{ ($imageStatics['percent'] < 80) ? '#ff0000' : (($imageStatics['percent'] < 90) ? '#FBB450' : '#5bb35b') }}', '#626E82'],

                        // Add series
                        series: [{
                            name: 'FOR SALE - READY',
                            type: 'pie',
                            radius: '45%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: {{ $imageStatics['all_with'] }}, name: 'Photos'},
                                {value: {{ $imageStatics['all_without'] }}, name: 'No Photos'},
                            ]
                        }]
                    };

                    chart.setOption(chartOptions);

                    // Resize chart
                    // ------------------------------

                    $(function () {

                        $('[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                            var target = $(e.target).attr("href") // activated tab
                            if(target == "#iamges-tab"){

                                chart.resize();
                            }
                        });

                        // Resize chart on menu width change and window resize
                        $(window).on('resize', resize);
                        $(".menu-toggle").on('click', resize);

                        // Resize function
                        function resize() {
                            setTimeout(function() {

                                chart.resize();

                            }, 200);
                        }
                    });
                }
            );
        });
    </script>
@stop


@push('page-js')

    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.date.js') !!}
    <script>
        $(document).ready(function(){
            $('.pickadate').pickadate({
                format:'yyyy-mm-dd'
            });
            
            $('.delete-news').on('click',function(){
                var id = $(this).data('id');
                var ele = swal({
                    title: "Are you sure",
                    text: "do you want to delete this news ?",
                    icon: "warning",
                    showCancelButton: true,
                    buttons: {
                        cancel: {
                            text: "No, cancel plx!",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: false,

                        },
                        confirm: {
                            text: "Yes Delete!!!",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: false
                        },
                    }
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        document.delete_form.id.value = id;
                        document.delete_form.submit();
                    } else {
                        swal("Cancelled", "It's safe.", "error");
                    }
                });
            });
        })
    </script>

    @if(session()->has('success'))
        <script>
            $(document).ready(function(){

                toastr.success('{{ session('success') }}', 'Success');

            })
        </script>
    @endif

@endpush

