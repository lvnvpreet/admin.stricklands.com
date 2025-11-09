@extends('layouts.app')

@section('page-title', trans('app.add_user'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           {{ ucfirst($location)}} - Add Booking
        </h1>
    </div>
</div>

@include('partials.messages')

{!! Form::open(['route' => ['boardroom.store',$location]]) !!}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Booking Details</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Booking Date: *</label>
                                <div class='input-group date'>
                                <input type="text" class="form-control" id="schedule_date"
                                       name="schedule_date" placeholder="Booking Date" value="{{ $edit ? $user->first_name : '' }}" required>
                                    <span class="input-group-addon" style="cursor: default;">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ext">Start Time: *</label>
                                <div class='input-group date'>
                                    <input type='text' placeholder="Start Time" name="start_time"
                                           value="{{ $edit ? $user->details->fld_usr_ext : '' }}" class="form-control boardroom_time" required />
                                    <span class="input-group-addon" style="cursor: default;">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="last_name">Reserved For: *</label>
                                    <input type="text" class="form-control"
                                           name="reserved_for" placeholder="Reserved For" value="{{ $edit ? $user->last_name : '' }}" required>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="visible">End Time: *</label>
                                <div class='input-group date'>
                                <input type="text" class="form-control boardroom_time"
                                       name="end_time" placeholder="End Time" value="{{ $edit ? $user->last_name : '' }}" required>
                                <span class="input-group-addon" style="cursor: default;">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="visible">Details</label>
                            <textarea name="details" class="form-control" rows="5"></textarea>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Save Booking
            </button>
        </div>
    </div>
{!! Form::close() !!}

@stop

@section('styles')
    {!! HTML::style('assets/css-rtl/plugins/pickers/bootstrap-datetimepicker-build.min.css') !!}
@stop

@section('top-scripts')
    {!! HTML::script('assets/js/jquery-2.1.4.min.js') !!}
    {!! HTML::script('assets/js/moment.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js') !!}

    <script>
        $('#schedule_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('.boardroom_time').datetimepicker({
            format: 'LT'
        });
    </script>

@endsection

@section('scripts')

@stop
