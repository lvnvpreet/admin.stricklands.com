@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="content-body">
        <!-- Full calendar basic example section start -->
        <section id="basic-examples">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ ucfirst($location) }} Calendar Schedule</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id='fc-default'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Full calendar basic example section end -->
    </div>
@stop

@section('scripts')
    {!! HTML::script('assets/vendors/js/extensions/moment.min.js') !!}
    {!! HTML::script('assets/vendors/js/extensions/fullcalendar.min.js') !!}
    {!! HTML::style('assets/vendors/css/calendars/fullcalendar.min.css') !!}
    <script>
        $(document).ready(function(){
            $('#fc-default').fullCalendar({
                defaultDate: '{{ date('Y-m-d') }}',
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    @foreach($schedules as $schedule)
                        {
                            id: {{ $schedule->id }},
                            title: '{{ date('h:i a',strtotime($schedule->start_time)) }} {{ date('h:i a',strtotime($schedule->end_time)) }} - {{ $schedule->details }}',
                            start: '{{ $schedule->date }}T{!! $schedule->start_time !!}',
                            end: '{{ $schedule->date }}T{!! $schedule->end_time !!}',
                            url: '{{ route('boardroom.list.detail',['location'=>$location,'date'=>$schedule->date]) }}'
                        }@if(!$loop->last),@endif
                    @endforeach
                ],
                eventClick: function(event) {
                    // opens events in a popup window
                    window.open(event.url, 'gcalevent', 'width=700,height=600');
                    return false;
                },
            });
        });
    </script>
    <style>
        .fc-content .fc-time{
            display: none;
        }
    </style>
@stop
