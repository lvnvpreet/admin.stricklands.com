@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Edit a Payment</h3>
        </div>
    </div>
    <div class="content-body">
        <section class="basic-elements">
            <div class="row">
                @include('partials.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit a payment</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="">
                                    {!! Form::model($payment,['route'=>array('payment.update', $payment->id),'id'=>'PaymentForm']) !!}

                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('product','Product') !!}
                                                    {!! Form::text('product',$payment->product,['class'=>'form-control border-primary','placeholder'=>"Product"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('code','Code') !!}
                                                    {!! Form::text('code',$payment->code,['class'=>'form-control border-primary','placeholder'=>"Code"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('phone','Phone') !!}
                                                    {!! Form::text('phone',$payment->phone,['class'=>'form-control border-primary','placeholder'=>"Phone"]) !!}
                                                </div>
                                            </div>

                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('address','Address') !!}
                                                    {!! Form::text('address',$payment->address,['class'=>'form-control border-primary','placeholder'=>"Address"]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('city','City') !!}
                                                    {!! Form::text('city',$payment->city,['class'=>'form-control border-primary','placeholder'=>"City"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('prov','Prov') !!}
                                                    {!! Form::text('prov',$payment->prov,['class'=>'form-control border-primary','placeholder'=>"Prov"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('postal','Postal') !!}
                                                    {!! Form::text('postal',$payment->postal,['class'=>'form-control border-primary','placeholder'=>"Postal"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('store_id','Store') !!}
                                                    {!! Form::select('store_id',$stores,$payment->store_id,['class'=>'form-control border-primary']) !!}
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
