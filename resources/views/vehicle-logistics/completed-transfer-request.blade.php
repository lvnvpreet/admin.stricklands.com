@extends('layouts.app')

@section('page-title', trans('menu.vehicle-logistics.'))

@section('content')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-7 col-12 ">
            <h3 class="content-header-title mb-0">Pending Transfer Request</h3>
        </div>
    </div>
    <div class="content-body">
        <section id="vehicle-logistics">
            <div class="row">
                @include('partials.messages')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="bd-example">
                                        <table class="table table-bordered table-hover table-responsive-lg mb-0 zero-configuration">
                                            <thead>
                                            <tr>
                                                <th scope="col">#Stock NO</th>
                                                <th scope="col">Current Location</th>
                                                <th scope="col">Transfer Location</th>
                                                <th data-toggle="tooltip" title="Transfer Date & Transfer Time" scope="col">Transfer On</th>
                                                <th data-toggle="tooltip" title="Transfer Method" scope="col">By</th>
                                                <th scope="col">Driver</th>
                                                <th scope="col">Requested By</th>
                                                <th>Authorized</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transferRequest as $tr)
                                                <tr id="tr-{{ $tr->id }}">
                                                    <td scope="row"><a target="_blank" href="{{ route('vehicle-logistics.search') }}?stock_no={{ $tr->stock_no }}">{{ $tr->stock_no }}</a></td>
                                                    <td>{{ $tr->current_location }}</td>
                                                    <td>{{ $tr->transfer_location }}</td>
                                                    <td>{{ date('d M, Y @ h:i a',strtotime($tr->transfer_date . ' ' . $tr->transfer_time)) }}</td>
                                                    <td>{{ $tr->transfer_method }}</td>
                                                    <td>{{ (!is_null($tr->driver)) ? (optional($tr->driverUser)->full_name ?? "NA") : "" }}</td>
                                                    <td>{{ optional($tr->user)->full_name ?? "NA"  }}</td>
                                                    <td class="text-center {{ ($tr->transfered == 1) ? "text-success" : "text-danger" }}"><i class="fa fa-{{ ($tr->transfered == 1) ? "check" : "times" }}"></i></td>
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
            </div>
        </section>
    </div>
@endsection
