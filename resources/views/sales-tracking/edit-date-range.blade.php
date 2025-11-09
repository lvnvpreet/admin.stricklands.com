<div class="modal fade text-left" id="edit-date-range" tabindex="-1" role="dialog" aria-labelledby="edit-date-range" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form form-horizontal" action="{{ url('update-sales-target') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="float: left;" class="modal-title" id="notes-edit-heading">EDIT TRACKING DATES</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control px-0" for="day_num" style="margin-top: 6px">Day #</label>
                                <div class="col-md-9">
                                    <input type="text" id="day_num" class="form-control" placeholder="Day #" name="day_num" value="{{ $stricklandTarget->day_num }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control px-0" for="days_total" style="margin-top: 6px">Of:</label>
                                <div class="col-md-9">
                                    <input type="text" id="days_total" class="form-control" placeholder="Total Days" name="days_total" value="{{ $stricklandTarget->days_total }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control px-0" for="day_start" style="margin-top: 6px">Starting:</label>
                        <div class="col-md-6">
                            <input type="text" id="day_start" class="form-control" placeholder="Starting Day" name="day_start" value="{{ $stricklandTarget->day_start }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal"
                           value="close">
                    <input type="submit" class="btn btn-outline-primary " value="Edit Dates" id="edit-dates">
                </div>
            </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade text-left" id="edit-location-target" tabindex="-1" role="dialog" aria-labelledby="edit-date-range" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form form-horizontal" action="{{ url('update-location-target') }}/{{ $location->id }}" method="post">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="float: left;" class="modal-title" id="notes-edit-heading">EDIT LOCATION TARGET</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-{{ ($location->id == 5 || $location->id == 8) ? '6' : '12' }} ">
                            <div class="form-group row">
                                <label class="col-md-3 label-control px-0" for="fldStoreTarget">Used Target</label>
                                <div class="col-md-9">
                                    <input type="text" id="fldStoreTarget" class="form-control" placeholder="Day #" name="fldStoreTarget" value="{{ $location->fldStoreTarget }}">
                                </div>
                            </div>
                        </div>
                        @if($location->id == 5 || $location->id == 8)
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control px-0" for="fldStoreNewTarget">New Target</label>
                                    <div class="col-md-9">
                                        <input type="text" id="fldStoreNewTarget" class="form-control" placeholder="Day #" name="fldStoreNewTarget" value="{{ $location->fldStoreNewTarget }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal"
                               value="close">
                        <input type="submit" class="btn btn-outline-primary " value="Edit Dates" id="edit-dates">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade text-left" id="edit-person-target" tabindex="-1" role="dialog" aria-labelledby="edit-person-target" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form form-horizontal" action="{{ url('update-salesman-target') }}" method="post" name="slsmn_trgt_frm">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="float: left;" class="modal-title" id="slsmn-trgt-head"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control px-0" for="fldStoreTarget">Used Target</label>
                                <div class="col-md-9">
                                    <input type="text" id="used_target" class="form-control" placeholder="Day #" name="used_target" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control px-0" for="fldStoreNewTarget">New Target</label>
                                <div class="col-md-9">
                                    <input type="text" id="new_target" class="form-control" placeholder="Day #" name="new_target" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" value="" id="salesman_id">
                        <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal"
                               value="close">
                        <input type="submit" class="btn btn-outline-primary " value="Edit Target" id="edit-target">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
@endpush

@push('page-vendor-js')
    {!! HTML::script('assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!}
@endpush

@section('scripts')
    <script>
        (function($){
            $(document).ready(function(){
                $("#day_start").datetimepicker({format:'YYYY-MM-DD'});

                $("#edit-person-target").on('show.bs.modal',function(ev){
                    $button = $(ev.relatedTarget)
                    $("#slsmn-trgt-head").html("Edit " + $button.data('name') + "'s target")
                    document.slsmn_trgt_frm.used_target.value = $button.data('used')
                    document.slsmn_trgt_frm.new_target.value = $button.data('new')
                    document.slsmn_trgt_frm.user_id.value = $button.data('id')
                })
            })
        })(jQuery)
    </script>
@endsection
