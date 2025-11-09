@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    @include('delivery-schedule.page-heading')
    <div class="row" style="margin-top: 20px;">
        @include('partials.messages')
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-12">
                            <form class="form form-horizontal" method="get">
                                <div class="form-body">
                                    <div class="form-group row mb-0">
                                        <label class="ml-1 mb-0" style="padding-top: 5px" for="eventRegInput1">Choose Delivery Date</label>
                                        <div class="mx-1">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" value="{{ request()->get('date') }}" class="form-control" placeholder="Select Date" aria-label="Select Date" name="date" id="date-input">
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary" style="padding: 0.50rem 1rem">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="" class="head1">Customer</th>
                            <th width="" class="head1">Vehicle</th>
                            <th width="" class="head1">Stk # </th>
                            <th width="" class="head1">Date</th>
                            <th width="" class="head1">Time</th>
                            <th width="" class="head1">Payment</th>
                            <th width="" class="head1">Sales</th>
                        </thead>
                        <tbody>
                        @if(isset($deliveries) && count($deliveries))
                            @foreach($deliveries as $delivery)
                                <tr>
                                    <td @if($delivery->fld_notes != "" || $delivery->fld_status == "Alert" )
                                        data-toggle="tooltip"
                                        data-html="true"
                                        data-placement="right"
                                        title="@if($delivery->fld_status == "Alert")
                                                <b>{{ wordwrap($delivery->al_notes) }}</b> <br/>
                                                    @endif {{ wordwrap($delivery->fld_notes,22,"<br/>\n") }}
                                                "
                                            @endif
                                    > {{-- tr closed --}}
                                        {{ str_limit($delivery->fld_customer,15) }} {{ ($delivery->fld_notes != "" || $delivery->fld_status == "Alert") ? "*" : "" }}
                                    </td>
                                    <td>
                                        @if($delivery->fld_stock != 'INCOMING')
                                            <a data-fancybox data-type="ajax" data-src="{{ route('inventory.list.popup',$delivery->fld_stock) }}">
                                                {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}
                                            </a>
                                        @else
                                            {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}

                                        @endif

                                    </td>
                                    <td>{{ $delivery->fld_stock }}</td>
                                    <td>{{ date('D-M-d',strtotime($delivery->fld_date)) }}</td>
                                    <td>{{ date('g:i A',strtotime($delivery->fld_time)) }}</td>
                                    <td nowrap @if($delivery->fld_payment != 'CASH' && $delivery->fld_payment != 'OTHER')
                                    data-toggle="tooltip"
                                        data-html="true"
                                        data-placement="right"
                                        title="{{ $delivery->payment->product . "<br/>" . $delivery->payment->address . "<br/>" . $delivery->payment->city . "," . $delivery->payment->prov . "<br/>" . $delivery->payment->postal }}
                                                "
                                            @endif
                                    >{{ $delivery->fld_payment }}@if($delivery->fld_payment != 'CASH' && $delivery->fld_payment != 'OTHER')*@endif</td>
                                    <td>{{ str_limit($delivery->userdetail->full_name) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    No result found for this date
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
@endpush
@push('page-vendor-js')
    {!! HTML::script('assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!}
@endpush

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#date-input").datetimepicker({format:'YYYY-MM-DD'});
        })
    </script>
@stop
