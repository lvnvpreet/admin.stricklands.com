@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">New Hire Contract Request Form</h3>
        </div>
        <div class="content-header-right col-md-6">
            <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                <a href="{{ route('hr-form.contract-request-form') }}" class="btn btn-outline-primary"> Back To List</a>
            </div>
        </div>
    </div>
    <div class="content-body pt-1">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @if($empReq->exists)
                                {!! Form::model($empReq,['route'=>['hr-form.contract-request.edit',$empReq->id]]) !!}
                            @else
                                {!! Form::open(['url'=>route('hr-form.contract-request.create'),'id'=>'contract-form']) !!}
                            @endif
                            <div class="row justify-content-between">
                                <div class="col-md-5">
                                    <h4>REQUIRED INFORMATION</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            {!! Form::label('first_name','First Name *') !!}
                                            {!! Form::text('first_name',NULL,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            {!! Form::label('last_name','Last Name *') !!}
                                            {!! Form::text('last_name',NUll,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('email','Email *') !!}
                                                {!! Form::text('email',NULL,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('phone','Phone *') !!}
                                                {!! Form::text('phone',NUll,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('address','Address *') !!}
                                                {!! Form::text('address',NULL,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('location','Location *') !!}
                                                {!! Form::text('location',NUll,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('wage','Wage *') !!}
                                                {!! Form::text('wage',NULL,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('position','Position *') !!}
                                                {!! Form::text('position',NUll,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('department','Department *') !!}
                                                {!! Form::text('department',NULL,['class'=>'form-control','required'=>true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <h4>PREFERRED INFORMATION</h4>
                                    <div class="form-group">
                                        {!! Form::label('start_date','Rough Start Date') !!}
                                        {!! Form::text('start_date',NULL,['class'=>'form-control','id'=>'start_date']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('notes','Notes') !!}
                                        {!! Form::textarea('notes',NULL,['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendor-css')
    {!! HTML::style('assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
@endpush
@push('page-vendor-js')
    {!! HTML::script('assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!}
@endpush

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#start_date").datetimepicker({format:'YYYY-MM-DD'});
        });

        @if($errors->any())
        $(document).ready(function(){
            var ErrorList = "<ul>";
            @foreach($errors->all() as $mes)
                ErrorList += "<li>{{ $mes }}</li>";
            @endforeach
                ErrorList += "</ul>";

            swal({
                title:'Validation Error',
                text:ErrorList,
                icon:'warning',
                html:true,
            })

        });
        @endif
    </script>
    {!! JsValidator::formRequest('Vanguard\Http\Requests\ContractCreateRequest', '#contract-form') !!}
@endsection
