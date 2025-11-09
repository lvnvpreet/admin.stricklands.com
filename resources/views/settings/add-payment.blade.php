@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Create a Payment</h3>
        </div>
    </div>
    <div class="content-body">
        <section class="basic-elements">
            <div class="row">
                @include('partials.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add a payment</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="">
                                    {!! Form::open(['route'=>'payment.store','id'=>'PaymentForm']) !!}

                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('product','Product') !!}
                                                    {!! Form::text('product',NULL,['class'=>'form-control border-primary','placeholder'=>"Product"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('code','Code') !!}
                                                    {!! Form::text('code',NULL,['class'=>'form-control border-primary','placeholder'=>"Code"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('phone','Phone') !!}
                                                    {!! Form::text('phone',NULL,['class'=>'form-control border-primary','placeholder'=>"Phone"]) !!}
                                                </div>
                                            </div>

                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('address','Address') !!}
                                                    {!! Form::text('address',NULL,['class'=>'form-control border-primary','placeholder'=>"Address"]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('city','City') !!}
                                                    {!! Form::text('city',NULL,['class'=>'form-control border-primary','placeholder'=>"City"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('prov','Prov') !!}
                                                    {!! Form::text('prov',NULL,['class'=>'form-control border-primary','placeholder'=>"Prov"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('postal','Postal') !!}
                                                    {!! Form::text('postal',NULL,['class'=>'form-control border-primary','placeholder'=>"Postal"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('store_id','Store') !!}
                                                    {!! Form::select('store_id',$stores,null,['class'=>'form-control border-primary']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\SupportTicketRequest', '#SupportForm') !!}
@endsection
