@extends('layouts.app')

@section('page-title', 'Image Statistics')

@section('content')
    <div class="row-fluid">
        <div class="card">
            <div class="card-header">
                <h2 style="text-transform:initial" class="card-title">Image Statistics by Location<small>&nbsp;&nbsp;&nbsp;These numbers do not include vehicles Not Here or Pending Sale....</small></h2>
            </div>
            <div class="card-body px-1" id="pie-doughnut-charts">
                @foreach($data as $d)
                    <div class="col-md-6 col-xs-12 ">
                        <div class="card-header">
                            <h4 style="text-transform:initial" class="card-title px-0 py-0">{{ $d['title'] }} - {{ $d['all_without'] }} Without - {{ $d['total'] }} Total, {{ $d['percent'] }}%</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="{{ str_slug($d['title']) }}-chart" data-text="testing" class="height-400 echart-container"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-6 col-xs-12 ">
                    <div class="card-header p-1">
                        <h4 style="text-transform:initial" class="card-title px-0 py-0">Printable Lists</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="">
                            <ul class="pl-1">
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=NH">Strickland's Not Here</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=E">Strickland's Automart Stratford</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=T">Stratford Toyota</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=BG">Brantford GMC</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=BA">Brantford Automart</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=P">Plated Vehicles</a></li>
                                <li><a target="_blank" href="{{ route('list-barcode') }}?location=W">Strickland's Windsor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



@section('scripts')
    {!! HTML::script('assets/vendors/js/charts/echarts/echarts.js') !!}
    <script>
        $(window).on("load", function(){
            require.config({
                paths: {
                    echarts: base_url+'/assets/vendors/js/charts/echarts'
                }
            });
            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],

                // Charts setup
                function (ec) {
                    @foreach($data as $index=>$d)
                        var {{ $index }} = ec.init(document.getElementById('{{ str_slug($d['title']) }}-chart'));
                        var {{ $index }}Options = {
                            title: {
                                text: '{{ $d['title'] }} Photo Count',
                                //subtext: 'Open source information',
                                x: 'center'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{b}: {c} ({d}%)"
                            },

                            legend: {
                                orient: 'vertical',
                                x: 'left',
                                data: ['Photos', 'No Photos']
                            },
                            color: ['{{ ($d['percent'] < 80) ? '#ff0000' : (($d['percent'] < 90) ? '#FBB450' : '#5bb35b') }}', '#626E82'],

                            // Add series
                            series: [{
                                name: 'FOR SALE - READY',
                                type: 'pie',
                                radius: '45%',
                                center: ['50%', '57.5%'],
                                data: [
                                    {value: {{ $d['all_with'] }}, name: 'Photos'},
                                    {value: {{ $d['all_without'] }}, name: 'No Photos'},
                                ]
                            }]
                        };

                    {{ $index }}.setOption({{ $index }}Options);


                    @endforeach
                    // Resize chart
                    // ------------------------------

                    $(function () {
                        // Resize chart on menu width change and window resize
                        $(window).on('resize', resize);
                        $(".menu-toggle").on('click', resize);

                        // Resize function
                        function resize() {
                            setTimeout(function() {
                                @foreach($data as $index=>$d)
                                    {{ $index }}.resize();
                                @endforeach
                            }, 200);
                        }
                    });
                }
            );
        });
    </script>
@stop
