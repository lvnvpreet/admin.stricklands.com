@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div>

        <!--<h4 style="margin-bottom: 20px; font-size: 16px;">Vehicle {{ $vehicles->count() }} || Used Available For Sale: {{ \Vanguard\Models\Vehicles::where('fldStatusCode','U')->where('fldSoldStatus',0)->where('fldKey1','<>','P')->where('fldLocation','!=','IT')->count() }}
            || New Vehicles For Sale: {{ $allvehicles->where('fldStatusCode','N')->where('fldSoldStatus',0)->wherein('fldLocationCode',['BG','G','W','E','T','BR','DL'])->count() }}  ||
            In Transit: {{ $allvehicles->where('fldLocationCode','IT')->where('fldStatusCode','<>','N')->count() }} || Wholesale:
            {{ $allvehicles->where('fldCode','A')->where('fldKey1','<>','P')->count() }}
            || Deals In Process:  {{ $allvehicles->where('fldStatusCode','U')->where('fldKey1','P')->count() }} || Demos:  {{ $allvehicles->where('fldLocationCode','DL')->where('fldKey1','<>','P')->count() }}
        </h4>-->
            <p class="invisible" style="display: none;">
                {{ $DL = $allvehicles->where('fldLocation', 'DL')->count() }}
                {{$DL1 = $DL / 2}}
                {{ $UV = \Vanguard\Models\Vehicles::where('fldStatusCode','U')->where('fldSoldStatus',0)->where('fldCode','<>','P')->where('fldKey2','<>','H')->where('fldKey2','<>','X')->where('fldLocation','<>','IT')->where('fldLocation', '<>', 'DL')->where('fldLocation','<>','A')->where('fldCode', '<>', 'A')->count() }}
                Demos: {{json_encode($DL1) }}
                {{ $WholesalePending = \Vanguard\Models\Vehicles::where('fldStatusCode','U')->where('fldCode','A')->where('fldKey2','<>','H')->where('fldCode','=','P')->where('fldSoldStatus',0)->count() }}
                Demos: {{json_encode($DL1) }}</p>
            <?php
                $toyota= $allvehicles->where('fldStatusCode','N')->where('fldSoldStatus',0)->where('fldLocation','T')->where('fldKey1',"")->count();
                $gm=  $allvehicles->where('fldStatusCode','N')->where('fldSoldStatus',0)->where('fldLocation','BG')->where('fldKey1',"")->count();
                ?>
            <h4 style="margin-bottom: 20px; font-size: 16px;">Vehicle {{ $vehicles->count() }} ||
                Used Available For Sale:<a data-toggle="tooltip" data-placement="top" title="Vehicle is Used, For Sale, Not Pending, Not In Transit, Not Wholesale"> {{ $UV }} </a> ||
                {{--New Vehicles For Sale:<a data-toggle="tooltip" data-placement="top" title="Vehicle is New, For Sale"> {{ $allvehicles->where('fldStatusCode','N')->where('fldSoldStatus',0)->wherein('fldLocationCode',['BG','G','W','E','T','BR','BA','DL'])->count() - $allvehicles->where('fldStatusCode','N')->where('fldSoldStatus',0)->wherein('fldLocationCode',['BG','G','W','E','T','BR','BA','DL'])->where('fldKey1',"!=","")->count() }}</a>--}}
                New Toyota:<a data-toggle="tooltip" data-placement="top" title="Vehicle is New Toyta, For Sale">{{ $toyota }}</a>||
                New GM:<a data-toggle="tooltip" data-placement="top" title="Vehicle is New GM, For Sale">{{ $gm }}</a>||
                In Transit:<a data-toggle="tooltip" data-placement="top" title="Vehicle is In Transit, Used"> {{ $allvehicles->where('fldLocationCode','IT')->where('fldStatusCode','<>','N')->count() }}</a> ||
                Wholesale:<a data-toggle="tooltip" data-placement="top" title="Vehicle is Used, For Sale, Location Code 'A', ---| {{ $WholesalePending }} Pending Wholesale Deals |---"> {{ $allvehicles->where('fldCode','A')->where('fldKey2','<>','H')->where('fldCode','<>','P')->where('fldSoldStatus',0)->count()}}</a> ||
                All Deals In Process:<a data-toggle="tooltip" data-placement="top" title="Vehicle is Pending Sale, Used">  {{ $allvehicles->where('fldStatusCode','U')->where('fldCode','P')->count() }} </a> ||
                Demos: <a data-toggle="tooltip" data-placement="top" title="Vehicle is Demo & Loaner">  {{ $allvehicles->where('fldLocation','DL')->where('fldSoldStatus',0)->where('fldkey2', '<>','H')->count() }} </a>
            </h4>
    </div>
    <form action="{{ route('inventory.search') }}" method="get" class="row">
    <div class="col-12 top-search">
        <div style="float:left; width: 150px;">
            {{ Form::select('location', $locations,@$_GET['location'], ['class' => 'select2 col-12']) }}
        </div>
        <div style="float:left; width: 125px; margin-left: 5px;">
            {{ Form::select('inventory', $inventories, @$_GET['inventory'], ['class' => 'select2 col-12']) }}
        </div>
        <div style="float:left; width: 100px;margin-left: 5px;">
            {{ Form::select('type', $types, @$_GET['type'], ['class' => 'select2 col-12']) }}
        </div>
        <div style="float:left; width: 120px;margin-left: 5px;">
            <select class="select2 col-12" name="price">
                <option value="480000"  <?php if (!(strcmp(480000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>All Prices</option>
                <option value="30000" <?php if (!(strcmp(30000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $30,000</option>
                <option value="25000" <?php if (!(strcmp(25000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $25,000</option>
                <option value="20000" <?php if (!(strcmp(20000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $20,000</option>
                <option value="15000" <?php if (!(strcmp(15000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $15,000</option>
                <option value="10000" <?php if (!(strcmp(10000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $10,000</option>
                <option value="5000" <?php if (!(strcmp(5000, @$_GET['price']))) {echo "selected=\"selected\"";} ?>>Under $5,000 </option>
            </select>
        </div>
        <div style="float:left; width: 120px;margin-left: 5px;">
            <select class="select2 col-12" name="kms">
                <option value="all"  <?php if (!(strcmp("All", @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>All KM's</option>
                <option value="50000" <?php if (!(strcmp(50000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 50,000</option>
                <option value="75000" <?php if (!(strcmp(75000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 75,000</option>
                <option value="100000" <?php if (!(strcmp(100000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 100,000</option>
                <option value="125000" <?php if (!(strcmp(125000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 125,000</option>
                <option value="150000" <?php if (!(strcmp(150000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 150,000</option>
                <option value="200000" <?php if (!(strcmp(200000, @$_GET['kms']))) {echo "selected=\"selected\"";} ?>>Under 200,000 </option>
            </select>
        </div>

        <div style="float:left; width: 100px;margin-left: 5px;">
            <select class="select2 col-12" name="year">
                <option value="all">All Years</option>
                @for($y=(date('Y')+1);$y>=(date('Y')-20);$y--)
                    <option <?php if (!(strcmp($y, @$_GET['year']))) {echo "selected=\"selected\"";} ?> value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div style="float:left; width: 130px;margin-left: 5px;">
            {{ Form::select('make', $makes, @$_GET['make'], ['class' => 'select2 col-12']) }}
        </div>

        <div style="float:left; width: 120px;margin-left: 5px;">
            <input type="text" class="form-control" placeholder="Model" name="model" value="{{ @$_GET['model'] }}">
        </div>

        <div style="float:left; width: 100px;margin-left: 5px;">
            <input type="text" class="form-control" placeholder="Stock #" name="stock" value="{{ @$_GET['stock'] }}">
        </div>
        <div style="float:left; width: 100px;margin-left: 5px;">
            <input type="submit" class="btn btn-primary" value="Filter">
        </div>


    </div>
    </form>

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">

              @include('inventory.list-load')

            </div>
        </div>

    </div>
@stop

@section('top-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    {{--<script type="text/javascript">

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



    </script>--}}

    <script>
        $('.table').dataTable({
           "pageLength": 25,
           drawCallback: function() {
                $('[data-toggle="tooltip"]').tooltip()
            }
        });


    </script>
@stop
