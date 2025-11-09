@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    @include('delivery-schedule.page-heading')

    <div class="row" style="margin-top: 20px;">
        @include('partials.messages')
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-hover table-bordered zero-configuration">
                        <thead>
                        <th width="2%" class="head1"><i class="fa fa-road"></i></th>
                        <th width="10%" class="head1">Customer</th>
                        <th width="11%" class="head1">Vehicle</th>
                        <th width="5%" class="head1">Vin</th>
                        <th width="5%" class="head1">Stk # </th>
                        <th width="8%" class="head1">Date</th>
                        <th width="6%" class="head1">Time</th>
                        <th width="6%" class="head1">Status</th>
                        <th width="6%" class="head1">D TECH</th>
                        <th width="6%" class="head1">D W.O.</th>
                        <th width="6%" class="head1">D KEYS</th>
                        <th width="6%" class="head1">COMPLETE</th>
                        <th width="6%" class="head1">TIME</th>
                        <th width="2%" class="head1">E</th>
                        </thead>
                        <tbody>
                        @if(isset($deliveries) && count($deliveries))
                            @foreach($deliveries as $delivery)
                                <tr style="background-color: {{ $delivery->tbl_bg_color }}">
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
                                    <td>{{ $delivery->fld_vin }}</td>
                                    <td>{{ $delivery->fld_stock }}</td>
                                    <td>{{ date('D-M-d',strtotime($delivery->fld_date)) }}</td>
                                    <td>{{ date('g:i A',strtotime($delivery->fld_time)) }}</td>
                                    <td>{!! Form::select('fld_status_'.$delivery->id,['OK'=>'OK','Delay'=>'Delay','Alert'=>'Alert'],$delivery->fld_status,["class"=>"form-control","onchange"=>"update_delivery(this,'fld_status',".$delivery->id.")"]) !!}</td>
                                    <td>{!! Form::select('d_who_'.$delivery->id,$detail_techs,$delivery->d_who,["class"=>"form-control","onchange"=>"update_delivery(this,'d_who',".$delivery->id.")"]) !!}</td>
                                    <td class="{{ ($delivery->d_w_o == 'Yes') ? 'alert-success' : 'alert-danger' }}">
                                        {!! Form::select('d_w_o_'.$delivery->id,['No'=>'No','Yes'=>'Yes'],$delivery->d_w_o ,["class"=>"form-control","onchange"=>"update_delivery(this,'d_w_o',".$delivery->id.")"]) !!}
                                    </td>
                                    <td class="{{ ($delivery->d_keys == 'Yes') ? 'alert-success' : 'alert-danger' }}" >
                                        {!! Form::select('d_keys_'.$delivery->id,['No'=>'No','Yes'=>'Yes'],$delivery->d_keys,["class"=>"form-control","onchange"=>"update_delivery(this,'d_keys',".$delivery->id.")"]) !!}
                                    </td>
                                    <td class="{{ ($delivery->d_complete == 'Yes') ? 'alert-success' : 'alert-danger' }}">
                                        {!! Form::select('d_complete_'.$delivery->id,['No'=>'No','Yes'=>'Yes'],$delivery->d_complete,["class"=>"form-control","onchange"=>"update_delivery(this,'d_complete',".$delivery->id.")"]) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('d_time_'.$delivery->id,$delivery->d_time,["class"=>"form-control","onchange"=>"update_delivery(this,'d_time',".$delivery->id.")"]) !!}
                                    </td>
                                    <td class="text-center"><a data-target="#notes-popup" data-toggle="modal" data-id="{{ $delivery->id }}"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>



    <style>
        select.form-control{
            padding: 0 3px;
        }
        table.dataTable thead>tr>th.sorting_asc,
        table.dataTable thead>tr>th.sorting_desc,
        table.dataTable thead>tr>th.sorting,
        table.dataTable thead>tr>td.sorting_asc,
        table.dataTable thead>tr>td.sorting_desc,
        table.dataTable thead>tr>td.sorting{
            padding-right: 8px;
        }
    </style>

    @include('delivery-schedule.edit-notes')

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>


@stop
