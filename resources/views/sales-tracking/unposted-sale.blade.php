@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{ $deliveries->count() }} {{ $location->fldLocationName }} Delivered & Funded to be Posted</h3>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        @include('partials.messages')
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-hover table-bordered zero-configuration">
                        <thead>
                        <th width="5%" class="head0">Delivered</th>
                        <th width="5%" class="head0">Funded</th>
                        <th width="5%"class="head0">Posted</th>
                        <th width="15%" class="head1">Customer</th>
                        <th width="20%" class="head1">Vehicle</th>
                        <th width="8%" class="head1">Stk # </th>
                        <th width="10%" class="head1">Date</th>
                        <th width="8%" class="head1">Time</th>
                        <th width="8%" class="head1">Bank</th>
                        <th width="8%" class="head1">Sales</th>
                        <th width="8%" class="head1">Sales</th>
                        <th width="5%" class="head1">E</th>
                        </thead>
                        <tbody>
                        @if(isset($deliveries) && count($deliveries))
                            @foreach($deliveries as $delivery)
                                <tr {{--style="background-color: {{ $delivery->tbl_bg_color }}"--}}>
                                    <td class="text-center">
                                        <img src="/assets/img/fugue/{{ ($delivery->fld_hdn == 'Yes') ? 'tick' : 'cross'  }}-circle-faded.png" width="16" height="16"  class="lens" />
                                    </td>
                                    <td class="text-center">
                                        <img src="/assets/img/fugue/{{ ($delivery->fld_funded == 'Yes') ? 'tick' : 'cross' }}-circle-faded.png" width="14" height="12"  class="lens" />
                                    </td>
                                    <td>
                                        {!! Form::select('fld_posted_'.$delivery->id,['No'=>'No','Yes'=>'Yes'],$delivery->fld_posted,["class"=>"form-control","onchange"=>"update_delivery(this,'fld_posted',".$delivery->id.")"]) !!}
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
                                        @if($delivery->fld_stock != 'INCOMING' && $delivery->vehicle()->exists())
                                            <a href="{{ route('vehicle-details',$delivery->vehicle->fldStockNo) }}">
                                                {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}
                                            </a>
                                        @else
                                            {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}

                                        @endif

                                    </td>
                                    <td>{{ $delivery->fld_stock }}</td>
                                    <td>{{ date('D d M, Y',strtotime($delivery->fld_date)) }}</td>
                                    <td>{{ date('g:i A',strtotime($delivery->fld_time)) }}</td>
                                    <td>{{ $delivery->fld_payment }}</td>
                                    <td>{{ $delivery->userdetail->full_name }}</td>
                                    @if(!is_null($delivery->fld_sperson2))
                                        <td>{{ $delivery->saleperson2->full_name }}</td>
                                    @else
                                        <td>&nbsp;</td>
                                    @endif
                                    <td class="text-center"><a href="{{ route('delivery-schedule-edit',[$delivery->id]) }}"><i class="fa fa-pencil"></i></a></td>
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
    <script>
        $(document).on('delivery_update',function(ev,ele,field){
            ele.parentNode.parentNode.remove();
        })
    </script>
@stop
