@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h2 class="panel-title">Vehicles At Auction</h2>
                        </div>
                        <div class="col col-xs-6 text-right">

                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered datatable" id="dyntable">
                        <thead>
                        <th>Stock Number</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>VIN</th>
                        <th>Added By</th>
                        <th>Auction</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($vehicle_data as $data)
                            <tr>
                                <td>{{ $data['fld_stock_number'] }}</td>
                                <td>{{ $data['fldYear'] }}</td>
                                <td>{{ $data['fldMake'] }}</td>
                                <td>{{ $data['fldModel'] }}</td>
                                <td>{{ $data['fldShortVINNo'] }}</td>
                                <td>{{ $data['fld_usr_fname'].' '.$data['fld_usr_lastname'] }}</td>
                                <td>{{ $data['fld_auction'] }}</td>
                                <td>
                                    <button id="myBtn2" class="btn btn-md btn-default myBtn2" data-toggle="model" data-id="{{$data['id']}}" type="button">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: darkred;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Are You Confirm To Delete It ?</h4>
                </div>
                <div class="modal-body" >
                    <h5><strong>Note:</strong>Please click No, if you click on confirm, the data will delete permanently </h5>
                </div>
                <div class="modal-footer">
                    <form id="modelDelete" action="" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-md btn-primary">Confirm</button>
                    </form>

                    <button type="button"  class="btn btn-md" data-dismiss="modal">NO</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('page-js')
    <script>

        $(document).ready(function () {
            $(".datatable").dataTable({
                "order": []
               });

            $(".myBtn2").click(function(){
                $("#myModal2").modal({backdrop: false});
                let id = $(this).data('id');
                let url = "{{ url('inventory/vehicle-delete') }}";
                 $('#modelDelete').attr('action', url+'/'+id );
            });
        });
    </script>
@endpush
