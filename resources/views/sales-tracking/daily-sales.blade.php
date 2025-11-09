@extends('layouts.app')

@section('content')
    <div class="content-header row mb-1">
        <div class="content-header-left col-md-8 col-sm-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Daily Sold Vehicles</h3>
        </div>
        <div class="content-header-right col-md-4 col-sm-6 col-12">
            <form method="GET">
                <div class="input-group">
                    <span class="input-group-addon">Date</span>
                    <input type="text" class="form-control pickadate" style="cursor: pointer !important;" name="date" value="{{ request('date',date('Y-m-d')) }}" placeholder="Date">
                    <button class="input-group-addon btn btn-primary" type="submit" style="color: #ffffff"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">SALES ON {{ request('date',date('Y-m-d')) }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead>
                                <tr>
                                    <th><b>Location</b></th>
                                    <th><b>Year	</b></th>
                                    <th><b>Model</b></th>
                                    <th><b>Colour</b></th>
                                    <th><b>KMs</b></th>
                                    <th><b>Stock</b></th>
                                    <th><b>VIN</b></th>
                                    <th><b>Days</b></th>
                                    <th><b>Customer</b></th>
                                    <th><b>Trade</b></th>
                                    <th><b>Sold By</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->location->fldLocationName }}</td>
                                        <td>{{ $sale->fld_year }}</td>
                                        <td>{{ $sale->fld_model }}</td>
                                        <td>{{ $sale->fld_color }}</td>
                                        <td>@if($sale->vehicle){!! $sale->vehicle->fldOdometer !!} @endif</td>
                                        <td>{{ $sale->fld_stock }}</td>
                                        <td>{{ $sale->fld_vin }}</td>
                                        <td>@if($sale->vehicle) {!! $sale->vehicle->stock_days !!} days @endif</td>
                                        <td>{{ $sale->fld_customer }}</td>
                                        <td>{{ $trade->trade }}</td>
                                        <td>{{ $sale->saleperson->full_name }}&nbsp;&nbsp;@if($sale->saleperson2) {{ $sale->saleperson2->full_name }}  @endif</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/pickers/pickadate/pickadate.css') !!}
@endpush

@push('page-js')
    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.date.js') !!}

    <script>
        $(document).ready(function(){
            $('.pickadate').pickadate({
                format:'yyyy-mm-dd'
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
