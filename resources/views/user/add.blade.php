@extends('layouts.app')

@section('page-title', trans('app.add_user'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Add Employee
        </h1>
    </div>
</div>

@include('partials.messages')

{!! Form::open(['route' => 'user.store', 'files' => true, 'id' => 'user-form']) !!}
    <div class="row">
        <div class="col-md-8">
            @include('user.partials.details', ['edit' => false, 'profile' => false])
        </div>
        <div class="col-md-4">
            @include('user.partials.auth', ['edit' => false])
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Save Employee
            </button>
        </div>
    </div>
{!! Form::close() !!}

@stop

@section('styles')
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
@stop

@section('scripts')
    {!! HTML::script('assets/js/moment.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
