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
                                                <th scope="col">Sold Status</th>
                                                <th scope="col">Requested By</th>
                                                @if(auth()->user()->details->fld_logistics_level == 1)
                                                    <th></th>
                                                    <th></th>
                                                @else
                                                    <th></th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transferRequest as $tr)
                                                @if($tr->vehicle)
                                                    <tr id="tr-{{ $tr->id }}">
                                                        <td scope="row"><a data-toggle="tooltip" data-placement="top" title="{{ optional($tr->vehicle)->fldMake }} {{ $tr->vehicle->fldModel }} " href=" {{ route('vehicle-logistics.search') }}?stock_no={{ $tr->stock_no }} ">{{ $tr->stock_no }}</a></td>
                                                        <td>{{ $tr->current_location }}</td>
                                                        <td>{{ $tr->transfer_location }}</td>
                                                        <td>{{ date('d M, Y @ h:i a',strtotime($tr->transfer_date . ' ' . $tr->transfer_time)) }}</td>
                                                        <td>{{ $tr->transfer_method }}</td>
                                                        <td>{{ (!is_null($tr->driver)) ? $tr->driverUser->full_name : "" }}</td>
                                                    <!-- <td style="text-align: center;"><img src="/assets/img/fugue/{{ ($tr->vehicle->fldSoldStatus != 0) ? 'tick' : 'cross' }}-circle.png" width="14" height="12"  class="lens" /></td> -->
                                                        <td>{{ ($tr->vehicle->fldSoldStatus !=  0 || $tr->vehicle->fldKey1 != "") ? 'Yes' : 'No' }}</td>
                                                        <td>{{ $tr->user->full_name  }}</td>
                                                        @if(auth()->user()->details->fld_logistics_level == 1)
                                                            <td>
                                                                <button class="btn btn-danger btn-sm decline-btn" data-id="{{ $tr->id }}">
                                                                    Decline
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-success btn-sm accept-btn" data-id="{{ $tr->id }}">
                                                                    Accept
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td>Pending</td>
                                                        @endif
                                                    </tr>
                                                    
                                                @endif
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

@push('page-js')
    <script>
        function updateRequestStatus(id,status){
            var container = $("#tr-" + id);

            $.ajax({
                url:'/vehicle-logistics/update-transfer-request',
                method:'POST',
                data:{'id':id,'status':status},
                beforeSend:function(){ beforeAjaxBlockUi(container)},
                complete:function(){
                    container.remove();
                },
                success:function(res){
                    onAjaxSuccess(res);
                },
                error:onAjaxErrorSweetAlert
            })
        }

        (function(){
            $(document).ready(function(){
                $('.decline-btn').click(function(){
                    var id = $(this).data('id')
                    updateRequestStatus(id,2);
                });

                $('.accept-btn').click(function(){
                    var id = $(this).data('id')
                    updateRequestStatus(id,1);
                });
            })
        })(jQuery)
    </script>
@endpush
