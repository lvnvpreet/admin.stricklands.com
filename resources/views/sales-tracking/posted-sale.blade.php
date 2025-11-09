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
                    <table class="table table-hover table-bordered" id="posted-sale-datatable">
                        <thead>
                            <th width="5%" class="head0">Delivered</th>
                            <th width="5%" class="head0">Funded</th>
                            <th width="6%"class="head0">Posted</th>
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
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div style="display: none">
        <img src="/assets/img/fugue/tick-circle-faded.png" id="tick-image" width="16" height="16"  class="lens" />
        <img src="/assets/img/fugue/cross-circle-faded.png" id="cross-image" width="16" height="16"  class="lens" />
        {!! Form::select('fld_posted_',['Yes'=>'Yes','No'=>'No'],'Yes',["class"=>"form-control","onchange"=>"",'id'=>'change-status', 'style'=>'padding : 0 3px']) !!}
    </div>

@endsection

@section('scripts')

    <script>

        var tick = document.getElementById('tick-image').cloneNode();
        tick.id = "";
        var cross = document.getElementById('cross-image').cloneNode();
        cross.id = "";
        var ChangeStatus =  document.getElementById('change-status').cloneNode(true);
        ChangeStatus.id = "";

        $(document).on('delivery_update',function(ev,ele,field){
            ele.parentNode.parentNode.remove();
        })

        $(document).ready(function(){
            $("#posted-sale-datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('posted-sale',[$location->id]) }}',
                rowCallback:function(tr, delivery, displayIndex, displayIndexFull){

                    var vehicle = "";
                    if(delivery.fld_stock != 'INCOMING' && delivery.vehicleDataExist){
                        vehicle += "<a target=\"_new\" href=\"{{ url('/') }}/vehicle-detail/"+delivery.fld_stock+"\">" +
                            "                                                " + delivery.fld_year  + " " + delivery.fld_make + " " + delivery.fld_model  +
                            "                                            </a>";
                    }else{
                        vehicle += delivery.fld_year  + " " + delivery.fld_make + " " + delivery.fld_model;
                    }
                    $(tr.children[4]).html( vehicle )

                    var customer_name = "";
                    if(delivery.fld_notes = null || delivery.fld_status == 'Alert'){
                        var tooltip = "";
                        if(delivery.fld_status == "Alert") tooltip += "<b>" + delivery.al_notes + "</b><br/>";
                        if(delivery.fld_notes != null) tooltip += delivery.fld_notes;
                        customer_name = delivery.fld_customer + "*";

                        $(tr.children[3]).html( customer_name ).tooltip({
                            'html' : true,
                            'title' : tooltip
                        });

                    }else{
                        $(tr.children[3]).html( delivery.fld_customer);
                    }

                    var salesperson2 = (delivery.saleperson2 != null)  ? delivery.saleperson2.full_name : "";
                    $(tr.children[10]).html(salesperson2);

                    $(tr.children[0]).addClass('text-center').html((delivery.fld_hdn == 'Yes') ? tick.cloneNode() : cross.cloneNode())
                    $(tr.children[1]).addClass('text-center').html((delivery.fld_funded == 'Yes') ? tick.cloneNode() : cross.cloneNode())

                    var select  = ChangeStatus.cloneNode(true);
                    select.onchange = function(){ update_delivery(this,'fld_posted',delivery.id) };

                    $(tr.children[2]).addClass('text-center').html(select);

                    $(tr.children[11]).html( '<a href="{{ url('/') }}/delivery-schedule/' + delivery.id + '/edit"><i class="fa fa-pencil"></i></a>' )
                },
                "order": [[ 4, "desc" ]],
                columns: [
                    {data: 'fld_hdn', name: 'fld_hdn',  orderable: false, searchable: false},
                    {data: 'fld_funded', name: 'fld_funded',orderable: false, searchable: false},
                    {data: 'fld_posted', name: 'fld_posted',orderable: false, searchable: false},
                    {data: 'fld_customer', name: 'fld_customer'},
                    {data: 'fld_model', name: 'fld_model'},
                    {data: 'fld_stock', name: 'fld_stock'},
                    {data: 'fld_date', name: 'fld_date'},
                    {data: 'fld_time', name: 'fld_time'},
                    {data: 'fld_payment', name: 'fld_payment'},
                    {data: 'saleperson.fld_usr_fname', name: 'saleperson.fld_usr_fname'},
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'id', name: 'id',orderable: false, searchable: false}
                ]
            })
        })

    </script>
@stop
