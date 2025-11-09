<div class="modal fade text-left" id="notes-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="float: left;" class="modal-title" id="notes-edit-heading"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <fieldset class="form-group floating-label-form-group">
                    <label for="fld_notes">Notes: </label>
                    <textarea class="form-control" name="fld_notes" cols="80" rows="2" id="fld_notes" placeholder="Notes"></textarea>
                </fieldset>
                <fieldset class="form-group floating-label-form-group">
                    <label for="alert_notes">Alert Notes</label>
                    <textarea class="form-control" name="alert_notes" id="alert_notes" rows="3" placeholder="Alert Notes"></textarea>
                </fieldset>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="notes-id">
                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
                       value="close">
                <input type="button" class="btn btn-outline-primary btn-lg" value="Edit Notes" id="save-notes">
            </div>
        </div>
    </div>
</div>

@push('page-js')
    <script>
        var Customers = {!! $deliveries->pluck('fld_customer','id')->toJson(); !!};
        var notes = {!! $deliveries->pluck('fld_notes','id')->toJson(); !!};
        var alert_notes = {!! $deliveries->pluck('al_notes','id')->toJson(); !!};
        (function($){
            $(document).ready(function(){
                $('#notes-popup').on('shown.bs.modal', function (ev) {
                    id = $(ev.relatedTarget).data('id');
                    $("#notes-id").val(id);
                    $('#notes-edit-heading').text('NOTES FOR ' + Customers[id]);
                    $('#fld_notes').val(notes[id]);
                    $('#alert_notes').val(alert_notes[id])

                })
            });

            $("#save-notes").click(function(){
                var modal = $("#notes-popup .modal-content");
                var id = $("#notes-id").val();
                data = {'id':id,'fld_notes':$('#fld_notes').val(),'al_notes':$('#alert_notes').val()}
                $.ajax({
                    'method':'post',
                    'data':data,
                    'url':'{{ url('delivery-schedule/ajax-update') }}',
                    'headers':{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
                    beforeSend:function(){
                        $(modal).block({
                            message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp;</div>',
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8,
                            },
                            css: {
                                border: 0,
                                padding: 0,
                                backgroundColor: 'transparent'
                            },
                            onBlock: function(){
                                clearTimeout();
                            }
                        });
                    },
                    success:function(res){
                        notes[id] = data.fld_notes;
                        alert_notes[id] = data.al_notes;
                        $.blockUI({
                            message: res.msg,
                            fadeIn: 700,
                            fadeOut: 700,
                            timeout: 50000,
                            showOverlay: false,
                            centerY: false,
                            css: {
                                width: '400px',
                                top: '20px',
                                left: '',
                                right: '20px',
                                border: 'none',
                                padding: '15px 5px',
                                backgroundColor: '#16D39A',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: 0.9,
                                color: '#fff'
                            }
                        });
                        window.setTimeout(function () {
                            $.unblockUI()
                        }, 2000);
                    },
                    complete:function(){
                        $(modal).unblock();
                        $('#notes-popup').modal('hide')
                    },
                    error:function (xhr,res) {
                        swal({
                            title:'Error',
                            text:(xhr.responseJSON.hasOwnProperty('msg')) ? xhr.responseJSON.msg : 'There was an error while processing your request',
                            icon: "error",
                            showCancelButton:false,
                            confirmButtonText:'OK',
                        })
                        $('#notes-popup').modal('hide')
                    }
                })
            });
        })(jQuery);
    </script>
@endpush
