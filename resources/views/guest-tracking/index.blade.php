
@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="row-fluid">
        <h4 style="margin-bottom: 20px; font-size: 16px;">{{ $name }} History Count : {{ $history->count() }} 
        <button type="button" class="btn btn-primary mx-2" onclick="$('.basic-elements').toggleClass('hidden')"><i class="ft-plus"></i> Add </button></h4>
    </div>
    @include('partials.messages')
    <section class="basic-elements hidden">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Entry</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::open(['route'=>'guest.tracking.save','id'=>'guestTrackingForm']) !!}
                                        @if($location == "all")
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('location_id','Location') !!}
                                                    {!! Form::select('location_id',$locations->pluck('fldLocationName','id'),NULL,['class'=>'form-control border-primary']) !!}
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="location_id" value="{{ $location }}">
                                        @endif
                                        <div class="form-body">
                                            <div class="form-group">
                                                {!! Form::label('guest_name','Guest Name') !!}
                                                {!! Form::text('guest_name',NULL,['class'=>'form-control border-primary','placeholder'=>"Guest Name"]) !!}
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                {!! Form::label('guest_city','Guest Home Location - City') !!}
                                                {!! Form::text('guest_city',NULL,['class'=>'form-control border-primary','placeholder'=>"Guest Home Location - City"]) !!}
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                {!! Form::label('guest_type','Type') !!}
                                                {!! Form::select('guest_type',$types->pluck('name','id'),NULL,['class'=>'form-control border-primary']) !!}
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                {!! Form::label('guest_used_new','Guest New/Used') !!}
                                                {!! Form::select('guest_used_new',[0=>'Select Option','New'=>'New','Used'=>'Used'],NULL,['class'=>'form-control border-primary']) !!}
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                {!! Form::label('arrival_time','Arrival Time') !!}
                                                {!! Form::date('arrival_time',null,['class'=>'form-control border-primary','placeholder'=>'Arrival Time']) !!}
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Guest Tracking</h2>
            </div>
            <div class="card-body">
                <div class="@if($location == 'all')col-xl-6 col-lg-6 @else col-xl-12 col-lg-12 @endif">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Types  <small> {{ $types->count() }} Total</small></h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="used-vehicles-sale-ready" data-text="testing" class="height-400 echart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($location == "all")
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Locations  <small> {{ $locations->count() }} Total</small></h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div id="locations-chart" data-text="testing" class="height-400 echart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table table-responsive">
              @include('guest-tracking.list-load')
            </div>
        </div>

    </div>
@stop

@section('top-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection


@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\GuestTrackingRequest', '#guestTrackingForm') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    {!! HTML::script('assets/vendors/js/charts/echarts/echarts.js') !!}
    <script>
        $(window).on("load", function(){
            var location = "{{ $location }}";
            // Set paths
            // ------------------------------

            require.config({
                paths: {
                    echarts: base_url+'/assets/vendors/js/charts/echarts'
                }
            });

            
            // Configuration
            // ------------------------------

            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],


                // Charts setup
                function (ec) {
                    // Initialize chart
                    var typeChart = ec.init(document.getElementById('used-vehicles-sale-ready'));

                    typeChartOptions = {
                        // Add title
                        title: {
                            text: 'Types',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: {!! json_encode($names) !!}
                        },

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'FOR SALE - READY',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: 
                                {!! json_encode($guest_history) !!}
                            
                        }]
                    };

                    // Apply options
                    // ------------------------------

                    typeChart.setOption(typeChartOptions);
                        
                    
                    
                    if(location == "all"){
                        var locationsChart = ec.init(document.getElementById('locations-chart'));
                        // Chart Options
                        // ------------------------------
                        chartOptions = {
                            // Add title
                            title: {
                                text: 'Locations',
                                //subtext: 'Open source information',
                                x: 'center'
                            },
    
                            // Add tooltip
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b}: {c} ({d}%)"
                            },
    
                            // Add legend
                            legend: {
                                orient: 'vertical',
                                x: 'left',
                                data: {!! json_encode($location_names) !!}
                            },
    
                            // Display toolbox
                            toolbox: {
                                show: true,
                                orient: 'vertical',
                                feature: {
                                    mark: {
                                        show: false,
                                        title: {
                                            mark: 'Markline switch',
                                            markUndo: 'Undo markline',
                                            markClear: 'Clear markline'
                                        }
                                    },
                                    saveAsImage: {
                                        show: true,
                                        title: 'Same as image',
                                        lang: ['Save']
                                    }
                                }
                            },
    
                            // Enable drag recalculate
                            calculable: true,
    
                            // Add series
                            series: [{
                                name: 'Locations',
                                type: 'pie',
                                radius: '70%',
                                center: ['50%', '57.5%'],
                                data: {!! json_encode($guest_history_by_locations) !!}
                            }]
                        };
    
                        // Apply options
                        // ------------------------------
    
                        locationsChart.setOption(chartOptions);
                    }

                    // Resize chart
                    // ------------------------------

                    $(function () {

                        // Resize chart on menu width change and window resize
                        $(window).on('resize', resize);
                        $(".menu-toggle").on('click', resize);

                        // Resize function
                        function resize() {
                            setTimeout(function() {
                                if(location == "all"){
                                    locationsChart.resize();
                                }
                                typeChart.resize();
                            }, 200);
                        }
                    });
                }
            );
        });
    </script>
    
    <script>
        $(document).ready(function(){
            $(".nav-tabs a").click(function(){
                $(this).tab('show');
                $(".nav-tabs li").removeClass('active');
                $(this).parent().addClass('active');
            });
            
            $('.table thead th').each(function (i) {
                if($(this).index() == 4){
                    var type = $('.table thead th')
                    .eq($(this).index())
                    .text();
                    $(this).html(
                        '<input type="text" id="'+type+'input" placeholder="' + type + '" data-index="' + i + '" />'
                    );
                }
            });
            
            var table = $('.table').dataTable({
               "pageLength": 25,
               "fixedColumns": true,
                drawCallback: function() {
                    $('[data-toggle="tooltip"]').tooltip()
                }
            });
            
            $("#Typeinput").on('keyup', function () {
                table.api().columns( $(this).data('index')).search( this.value ).draw();
            });
        
        });
    </script>
@stop

