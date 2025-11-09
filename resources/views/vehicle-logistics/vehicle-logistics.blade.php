@extends('layouts.app')

@section('page-title', trans('menu.vehicle-logistics.'))

@section('content')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-7 col-12 ">
            @if(request()->has('stock_no'))
                <h3 class="content-header-title mb-0">#{{ $vehicle->fldStockNo }}  - {{ $vehicle->fldShortVINNo }} - {{ $vehicle->fldYear }} - {{ $vehicle->fldMake }}- {{ $vehicle->fldModel }}
                    @if($vehicle->fldSoldStatus != 0)
                        <i class="red"> P</i>
                    @elseif($vehicle->fldSoldStatus = 1)
                    @endif
                </h3>
            @else
                <h3 class="content-header-title mb-0">Vehicle Logistics</h3>
            @endif
        </div>
        <div class="content-header-right col-md-5 col-8 align-self-end">
            <form method="get" class="form row">
                <div class="text-right col-4 pr-0">
                    <label class="ml-1 mb-0" style="padding-top: 5px" for="search-stock">{{ trans('menu.vehicle-logistics.search-by-stock') }}</label>
                </div>
                <div class="col-md-auto">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input placeholder="stock-no" class="form-control" name="stock_no" id="search-stock" value="{{ request()->get('stock_no') }}">
                    </div>

                </div>
                <div class="col-md-auto" style="padding: 0;">
                    <button type="submit" style="padding: 0.50rem 1rem" class="btn btn-primary" name="">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="content-body">
        <section id="vehicle-logistics">
            <div class="row">
                @include('partials.messages')
            </div>
            @if(request()->has('stock_no'))
                <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-content">
                                        @if(file_exists("/home/adminstrick/images.stricklands.com/vin/".$vehicle->fldStockNo."-1.jpg"))
                                            <img class="card-img-top img-fluid" src="https://images.stricklands.com/vin/{{ $vehicle->fldStockNo }}-1.jpg" alt="No Image">
                                        @else
                                            <img class="card-img-top img-fluid" src="{{ asset('assets/img/no-image.png') }}" alt="No Image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">VEHICLE NOTES (MOST RECENT AT TOP)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="list-group" id="vehicle-notes">
                                            @foreach($vehicle->logistic_notes as $notes)
                                                <li class="list-group-item">
                                                    <h4 class="card-title m-0 primary lighten-2">{{ $notes->note }}</h4>
                                                    <p class="card-subtitle text-muted mb-0 pt-1">
                                                        <span class="font-small-3">By <b>{{ $notes->user ? $notes->user->full_name : 'N/A' }}</b> on <b>{{ date('d M, Y',strtotime($notes->date)) }} at {{ date('h:i a',strtotime($notes->time)) }}</b></span>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer px-0 py-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <div class="input-group">
                                                        <input type="text" id="new-note" class="form-control col-12" width="100%" placeholder="Add new note">
                                                        <input type="hidden" value="{{ $vehicle->fldStockNo }}" name="v_stock_no" id="v_stock_no">
                                                        <span class="input-group-btn col-auto p-0">
                                                        <button id="add-note" class="btn btn-primary " style="padding: 6px 10px" type="button"><i class="fa fa-comment"></i></button>
                                                </span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-1">
                                        <h4>Location <b>180: {{ $vehicle->location->fldLocationName }}</b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card p-1">
                                <div class="card-header p-0">
                                    <h4 class="card-title">Lot Timers</h4>
                                </div>
                                <div class="card-content p-0 pt-1">
                                    <div class="row">
                                        @php
                                            $canEdit = auth()->user()->details->fld_logistics_level == 1;
                                            $lastLocation = $vehicle->timers()->orderBy('id','desc')->first();

                                        @endphp
                                        @foreach(['Stratford','Brantford','Windsor','Brantford Automart','Demos & Loaners','Auction'] as $key => $location)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Automart" class="font-medium-2 text-bold-600">{{ $location }}</label>
                                                    <br/>
                                                    @if($lastLocation && $location == $lastLocation->location)
                                                        @php
                                                            $checkin = \Carbon\Carbon::parse($lastLocation->checkin_date . ' ' . $lastLocation->checkin_time)->diffForHumans(null,true,false)
                                                        @endphp
                                                        <h5>{{ $checkin }}</h5>
                                                    @else
                                                        <form id="form-{{$key}}" action="{{ url('/vehicle-logistics/check-in') }}" method="post">
                                                            {{-- <input type="submit" class="btn btn-sm btn-primary check-in-btn" style="padding-top: 0.50rem;padding-bottom: 0.50rem;" name="check-in" value="Check In"> --}}
                                                            {{-- <div class="dropdown">
                                                              <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu{{$key}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Choose Type
                                                              </button>
                                                              <div class="dropdown-menu" aria-labelledby="dropdownMenu{{$key}}">
                                                                
                                                              </div>
                                                            </div> --}}
                                                            <div class="col-sm-3 col-6">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Choose Type
                                                                    </button>
                                                                    <div class="dropdown-menu arrow" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 41px, 0px);">
                                                                        <div style="padding: 10px;margin: 2px;">
                                                                            <input type="checkbox" name="type[]" value="File"> File<br>
                                                                            <input type="checkbox" name="type[]" value="Spare key"> Spare Key<br>   
                                                                            <input type="checkbox" name="type[]" value="Ownership"> Ownership<br>
                                                                            <input type="checkbox" name="type[]" value="Safety"> Safety<br>
                                                                            <input type="checkbox" name="type[]" value="Nothing"> Nothing<br>
                                                                            <button style="background: #16d39a;text-align: center;margin-top: 5px" class="dropdown-item" onclick="$('#form-{{$key}}').submit();" type="button">Submit</button></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="stock_no" value="{{ request()->stock_no }}">
                                                            <input type="hidden" name="location" value="{{ $location }}">
                                                            {!! csrf_field() !!}
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-1">
                                    <h4 class="card-title">Detail</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <div class="float-right">
                                                        <input value="{{ $vehicle->indicators->cleaned ? 0: 1 }}" type="checkbox" name="cleaned" id="cleaned-switchery" class="switchery" {{ $vehicle->indicators->cleaned ? "checked" : "" }}  />
                                                    </div>
                                                    <label for="cleaned-switchery" class="font-medium-2 text-bold-600">Cleaned</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <div class="float-right">
                                                        <input value="{{ $vehicle->indicators->pictured ? 0: 1 }}" type="checkbox" name="pictured" id="pictured-switchery" class="switchery" {{ $vehicle->indicators->pictured ? "checked" : "" }}  />
                                                    </div>
                                                    <label for="pictured-switchery" class="font-medium-2 text-bold-600">Pictured</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-1">
                                    <h4 class="card-title">Service</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <div class="float-right">
                                                        <input value="{{ $vehicle->indicators->safetied ? 0 : 1 }}" type="checkbox" name="safetied" id="safetied-switchery" class="switchery" {{ $vehicle->indicators->safetied ? "checked" : "" }}  />
                                                    </div>
                                                    <label for="safetied-switchery" class="font-medium-2 text-bold-600">Safetied</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <div class="float-right">
                                                        <input value="{{ $vehicle->indicators->etested ? 0 : 1 }}" type="checkbox" name="etested" id="etested-switchery" class="switchery" {{ $vehicle->indicators->etested ? "checked" : "" }} />
                                                    </div>
                                                    <label for="etested-switchery" class="font-medium-2 text-bold-600">E-Tested</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @if(auth()->user()->details->fld_logistics_level <= 3)--}}
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-1">
                                        <form class="form" action="post" id="tranfer-request">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> VEHICLE TRANSFER REQUEST</h4>
                                                <div class="row">
                                                    <div class="col-md-2 pr-0">
                                                        <div class="form-group mb-0">
                                                            <label for="to">To</label>
                                                            <select name="to" id="to" class="form-control">
                                                                @foreach(\Vanguard\Models\Locations::where('id','<',10)->get() as $location)
                                                                    <option value="{{ $location->fldShortName }}">{{ $location->fldShortName }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 pr-0">
                                                        <div class="form-group mb-0">
                                                            <label for="date">Date</label>
                                                            <input type="text" id="date" class="form-control" placeholder="Date" name="date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 pr-0">
                                                        <div class="form-group mb-0">
                                                            <label for="time">Time</label>
                                                            <input type="text" id="time" class="form-control" placeholder="Time" name="time">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 pr-0">
                                                        <div class="form-group mb-0">
                                                            <label for="method">Method</label>
                                                            <select id="method" class="form-control" name="method">
                                                                <option value="Truck">Truck</option>
                                                                <option value="Driver">Driver</option>
                                                                <option value="Halfway">Halfway</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 pr-0">
                                                        <div class="form-group mb-0">
                                                            <label for="salesname">Sales Rep</label>
                                                            <select name="salesname" class="form-control" id="salesname">
                                                                @foreach($salesmans as $salesman)
                                                                    <option value="{{ $salesman->id }}">{{ $salesman->tech_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 pr-0 align-self-end">
                                                        <button type="submit" class="btn btn-primary mt-1" style="padding: 0.50rem 1rem">
                                                            <i class="fa fa-check-square-o"></i> Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @endif--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">LOCATION HISTORY (MOST RECENT AT TOP)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Check In Date</th>
                                                        <th>Arrived With</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($timers as $timer)
                                                        <tr>
                                                            <th scope="row">{{ $timer->location }}</th>
                                                            <td>{{ date('D d, F Y',strtotime($timer->checkin_date)) }}</td>
                                                            <td scope="row">@if($timer->type && !is_null($timer->type)) {{ ucwords($timer->type) }} @else None @endif</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header pt-1">
                                    <h4 class="card-title">VEHICLE INFO</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-1">
                                        <h5>Days In Stock: <b>{{ $vehicle->total_days }}</b></h5>
                                        <h5>Distributor : <b>{{ $vehicle->fldDistributor }}</b></h5>
                                        <p> {{ $vehicle->fldComments }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </div>
@endsection

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/forms/toggle/switchery.min.css') !!}
    {!! HTML::style('assets/css/plugins/forms/switch.css') !!}
    {!! HTML::style('assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
@endpush

@push('page-vendor-js')
    {!! HTML::script('assets/js/bootstrap.min.js') !!}
    {!! HTML::script('assets/vendors/js/forms/toggle/switchery.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!}
@endpush


@push('page-js')
    {!! HTML::script('assets/js/pages/vehicle-logistics.js') !!}
@endpush
