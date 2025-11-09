@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">
                @include('inventory.tradein-load')
            </div>
        </div>

    </div>
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript">

        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#load a').css('color', '#dfecf6');


                var url = $(this).attr('href');
                getVehicles(url);
                window.history.pushState("", "", url);
            });

            function getVehicles(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#vehicles-wrap').html(data);
                }).fail(function () {
                    alert('Vehicle could not be loaded.');
                });
            }
        });



    </script>

    <script>
        $(document).ready(function(){
            $(".datatable").dataTable({
                "order": []
               });
            
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
