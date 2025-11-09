@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-10">
                            <h2 class="panel-title">Trade In Detail View | Entered By: {{ $delivery->trade_user ? $delivery->trade_user->details->fld_usr_fname .' '. $delivery->trade_user->details->fld_usr_lastname : ''  }} </h2>
                        </div>

                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Stock Number</th>
                            <th>Year</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Colour</th>
                            <th>KMs</th>
                            <th>VIN</th>
                            <th>Trim</th>
                            <th>Options</th>
                            <th>BOS/ACV</th>
                            <th style="color:blue;">Admin-Retail</th>
                            <th style="color:blue;">Admin-ACV</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $delivery->fld_trade_stock }}</td>
                            <td>{{ $delivery->fld_trade_year }}</td>
                            <td>{{ $delivery->fld_trade_make }}</td>
                            <td>{{ $delivery->fld_trade_model }}</td>
                            <td>{{ $delivery->fld_trade_colour }}</td>
                            <td>{{ $delivery->fld_trade_mileage }}</td>
                            <td>{{ $delivery->fld_trade_vin }}</td>
                            <td>{{ $delivery->fld_trade_trim }}</td>
                            <td>{{ ($delivery->fld_trade_options && is_array($delivery->fld_trade_options)) ? implode(',',$delivery->fld_trade_options) : $delivery->fld_trade_options }}</td>
                            <td>${{ $delivery->fld_trade_acv }}</td>
                            <td><span style="color:blue;">${{ $delivery->fld_trade_retail }}</span></td>
                            <td><span style="color:blue;">${{ $delivery->fld_trade_cost }}</span></td>
                        </tr>
                        </tbody>
                    </table>


                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Trade Status</th>
                            <th>Engine</th>
                            <th>Transmission</th>
                            <th>Drive</th>
                            <th>Fuel Type</th>
                            <th>Interior Condition</th>
                            <th>Exterior Condition</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $delivery->fld_trade_status }}</td>
                            <td>{{ $delivery->fld_trade_cylinder }}</td>
                            <td>{{ $delivery->fld_trade_transmission }}</td>
                            <td>{{ $delivery->fld_trade_drive }}</td>
                            <td>{{ $delivery->fld_trade_type }}</td>
                            <td>{{ $delivery->fld_trade_interior }}</td>
                            <td>{{ $delivery->fld_trade_exterior }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
