@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{ $location->fldLocationName }} Delivered - {{ $deliveries->count() }} | Delivery History</h3>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        @include('partials.messages')
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-hover table-bordered zero-configuration">
                        <thead>
                        <th width="5%" class="head0">OK</th>
                        <th width="5%" class="head0">S</th>
                        <th width="5%"class="head0">D</th>
                        <th width="5%" class="head1">$</th>
                        <th width="15%" class="head1">Customer</th>
                        <th width="20%" class="head1">Vehicle</th>
                        <th width="8%" class="head1">Stk # </th>
                        <th width="8%" class="head1">Date</th>
                        <th width="8%" class="head1">Time</th>
                        <th width="8%" class="head1">Bank</th>
                        <th width="8%" class="head1">Sales</th>
                        @permission('delivery.manage')
                            <th width="5%" class="head1">E</th>
                        @endpermission
                        </thead>
                        <tbody>
                        @if(isset($deliveries) && count($deliveries))
                            @foreach($deliveries as $delivery)
                                <tr {{--style="background-color: {{ $delivery->tbl_bg_color }}"--}}>
                                    <td class="text-center">
                                        @if($delivery->fld_pend == 'Yes')
                                            <img src="/assets/img/fugue/clock.png" width="16" height="16"  class="lens" />
                                        @elseif($delivery->fld_status == 'Alert')
                                            <img src="/assets/img/fugue/flag-bright.png" width="20" height="20"  class="lens" />
                                        @elseif($delivery->fld_status == 'OK')
                                            <img src="/assets/img/fugue/tick-circle-faded.png" width="14" height="12"  class="lens" />
                                        @else
                                            <img src="/assets/img/fugue/cross-circle-faded.png" width="14" height="12"  class="lens" />
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <img src="/assets/img/fugue/{{ ($delivery->fld_on_service == 'Yes') ? 'tick' : 'cross' }}-circle-faded.png" width="14" height="12"  class="lens" />
                                    </td>
                                    <td class="text-center">
                                        <img src="/assets/img/fugue/{{ ($delivery->fld_hdn == 'Yes') ? 'tick' : 'cross' }}-circle-faded.png" width="14" height="12"  class="lens" />
                                    </td>
                                    <td class="text-center">
                                        <img src="/assets/img/fugue/{{ ($delivery->fld_funded == 'Yes') ? 'tick' : 'cross' }}-circle-faded.png" width="14" height="12"  class="lens" />
                                    </td>
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
                                    <td>{{ $delivery->fld_payment }}</td>
                                    <td>{{ $delivery->userdetail->full_name }}</td>
                                    @permission('delivery.manage')
                                    <td class="text-center"><a href="{{ route('delivery-schedule-edit',[$delivery->id]) }}"><i class="fa fa-pencil"></i></a></td>
                                    @endpermission
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    No result found for this location
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
@stop
