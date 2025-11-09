@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    @include('partials.messages')

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div id="vehicles-wrap" class="panel panel-default panel-table">

                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h2 class="panel-title">Manage {{ ucfirst($location) }} Bookings</h2>
                        </div>
                        <div class="col col-xs-6 text-right">

                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <th width="15%" class="head0">Date</th>
                            <th width="15%" class="head0">Time</th>
                            <th width="25%" nowrap="nowrap" class="head0">Booked For</th>
                            <th width="30%" class="head1">Details</th>
                            <th width="15%" class="head0">Options</th>
                        </thead>
                        <tbody>
                        @if(isset($schedules) && count($schedules))
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{!! $schedule->date !!}</td>
                                    <td>{!! date('h:i a',strtotime($schedule->start_time)) !!} to {!! date('h:i a',strtotime($schedule->end_time)) !!}</td>
                                    <td>{!! $schedule->reserved_for !!}</td>
                                    <td>{!! Illuminate\Support\Str::limit($schedule->details,50) !!}</td>
                                    <td class="text-center">
                                        <form action="{!! route('boardroom.delete',['location'=>$location,'schedule'=>$schedule->id]) !!}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="btn-group btn-group-sm">
                                                <a href="{!! route('boardroom.edit',['location'=>$location,'schedule'=>$schedule->id]) !!}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                <button type="submit" onclick="return window.confirm('Are you sure you want to delete this entry ?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

@stop
