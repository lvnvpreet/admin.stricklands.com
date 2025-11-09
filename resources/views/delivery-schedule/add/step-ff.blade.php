@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Add Delivery for Stock #{{ request()->stock_no }}</h3>
        </div>
    </div>
    <div class="content-body">
        <!-- Form wizard with step validation section start -->
                <section  id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        @if(isset($delivery) && !empty($delivery))
                                            {!! Form::model($delivery,['route'=>['delivery-schedule-edit',$delivery->id],'id'=>'delivery-form','class'=>'steps-validation wizard-circle']) !!}
                                        @else
                                            {!! Form::model($vehicle,['route'=>'ff-delivery','id'=>'delivery-form','class'=>'steps-validation wizard-circle']) !!}
                                        @endif



                                            <!-- Step 1 -->
                                            <h6>Vehicle</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Tracking </h4></div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_tracker_type','Tracker'); !!}
                                                            {!! Form::select('fld_tracker_type',$trackingTypes,null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_new_used','Vehicle Status'); !!}
                                                            {!! Form::select('fld_new_used',[''=>'Choose One','3' => 'Buy', '2'=>'Used','1'=>'New'],null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_type','Type'); !!}
                                                            {!! Form::select('fld_type',[''=>'Choose One','C'=>'Car','S'=>'SUV','V'=>'Minivan','T'=>'Truck'],null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_location','Location'); !!}
                                                            {!! Form::select('fld_location',$locations,request()->location,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_on_service','Service'); !!}
                                                            {!! Form::select('fld_on_service',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_status','Status'); !!}
                                                            {!! Form::select('fld_status',[''=>'Select One','OK'=>'OK','Delay'=>'Delay','Alert'=>'Alert'],(isset($vehicle) ? 'OK' : null),['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_pend','Pending'); !!}
                                                            {!! Form::select('fld_pend',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],(isset($vehicle) ? 'No' : null),['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_hdn','Delivered'); !!}
                                                            {!! Form::select('fld_hdn',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],(isset($vehicle) ? 'No' : null),['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_funded','Funded'); !!}
                                                            {!! Form::select('fld_funded',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],(isset($vehicle) ? 'No' : null),['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-sm-2 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('s_spare','Dead'); !!}
                                                            {!! Form::select('s_spare',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],(isset($vehicle) ? 'No' : null),['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Stock/VIN </h4></div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        {!! Form::label('fld_stock','Stock'); !!}
                                                        {!! Form::text('fld_stock',(isset($vehicle) ? request()->stock_no : null),['class'=>'form-control required']) !!}
                                                    </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_vin','VIN#'); !!}
                                                            {!! Form::text('fld_vin',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_year','Year'); !!}
                                                            {!! Form::text('fld_year',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_make','Make'); !!}
                                                            {!! Form::text('fld_make',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_model','Model'); !!}
                                                            {!! Form::text('fld_model',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_color','Color'); !!}
                                                            {!! Form::text('fld_color',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Sale </h4></div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_sale_date','Sale Date') !!}
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-calendar"></span>
                                                                </span>
                                                                {!! Form::text('fld_sale_date',null,["class"=>"form-control required"]) !!}
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_date','Delivery Date') !!}
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-calendar"></span>
                                                                </span>
                                                                {!! Form::text('fld_date',null,["class"=>"form-control required"]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_time','Delivery Time') !!}
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-clock"></span>
                                                                </span>
                                                                {!! Form::text('fld_time',null,["class"=>"form-control required"]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_sperson','Sales Person'); !!}
                                                            {!! Form::select('fld_sperson',$salesPersons,null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_sperson2','Split'); !!}
                                                            {!! Form::select('fld_sperson2',$salesPersons,null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>


                                                    <div class="col-md-1 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_turn_over','Turn Over'); !!}
                                                            {!! Form::select('fld_turn_over',$turnOvers,(isset($vehicle) ? 'Yes' : null),['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <div class="col-md-1 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_paid','Paid'); !!}
                                                            {!! Form::select('fld_paid',[''=>'Y/N','Yes'=>'Yes','No'=>'No'],(isset($vehicle) ? 'Yes' : null),['class'=>'form-control']) !!}
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-1 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_paid_amount','Sales SPIF'); !!}
                                                            {!! Form::text('fld_paid_amount',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_paid_amount2','Split SPIF'); !!}
                                                            {!! Form::text('fld_paid_amount2',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Carproof/Manager Notes </h4></div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <div class="form-group">
                                                            {!! Form::textarea('fld_trade_notes',null,["placeholder"=>"Carproof/Manager Notes",'class'=>"form-control",'rows'=>2]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6>Trades</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Trade In </h4></div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_vin','Last 6 VIN'); !!}
                                                            {!! Form::text('fld_trade_vin',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_stock','Stock'); !!}
                                                            {!! Form::text('fld_trade_stock',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_acv','Trade Value'); !!}
                                                            {!! Form::text('fld_trade_acv',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::label('fld_trade_year','Trade Year'); !!}
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-calendar"></span>
                                                            </span>
                                                            {!! Form::text('fld_trade_year', isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_make','Make'); !!}
                                                            {!! Form::text('fld_trade_make',isset($delivery) ? null : '',["class"=>"form-control"]) !!}


                                                            {{-- if fld_trade_make is true then NULL if not true send to form control --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_model','Model'); !!}
                                                            {!! Form::text('fld_trade_model',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_colour','Colour'); !!}
                                                            {!! Form::text('fld_trade_colour',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_mileage','KM\'s'); !!}
                                                            {!! Form::text('fld_trade_mileage',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('trade_manager_acv','Trade Manager ACV'); !!}
                                                            {!! Form::text('trade_manager_acv',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_cylinder','Engine'); !!}
                                                            {!! Form::select('fld_trade_cylinder',[''=>'Choose One',4=>'4',6=>'6',8=>'8','other'=>'Other'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_transmission','Transmission'); !!}
                                                            {!! Form::select('fld_trade_transmission',[''=>'Choose One','Auto'=>'Auto','Manual'=>'Manual'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                        {{-- 'Auto'=>'Auto', --}}
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_drive','Driveline'); !!}
                                                            {!! Form::select('fld_trade_drive',[''=>'Choose One','FWD'=>'FWD','RWD'=>'RWD','AWD'=>'AWD','4X4'=>'4X4','4X2'=>'4X2'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_type','Fuel Type'); !!}
                                                            {!! Form::select('fld_trade_type',[''=>'Choose One','Gas'=>'Gas','Diesel'=>'Diesel','Hybrid'=>'Hybrid','Electric'=>'Electric'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_interior','Interior'); !!}
                                                            {!! Form::select('fld_trade_interior',[''=>'Choose One','Scrap'=>'Scrap','Dirty'=>'Dirty','Average'=>'Average','Clean'=>'Clean','Pin'=>'Pin'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_exterior','Exterior'); !!}
                                                            {!! Form::select('fld_trade_exterior',[''=>'Choose One','Scrap'=>'Scrap','Turd'=>'Turd','Average'=>'Average','Clean'=>'Clean','Pin'=>'Pin'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>

                                                    @php
                                                        $trade_options = ['A','C','T','CD','PW','PL','SK','KE','START','RCAM','PS','L','HS','PR','ALL','CH','NAV','BLUE','DVD','VS','TOW'];
                                                    @endphp
                                                    @foreach($trade_options as $opt)
                                                        <div class="col-md-1 col-sm-1 col-xs-2 {{ $loop->first ? 'pr-0' : ($loop->last ? 'px-0' : 'pr-0' ) }}">
                                                            <div>
                                                                <label class="custom-control custom-checkbox mr-0">
                                                                    {!! Form::checkbox('fld_trade_options[]',$opt,isset($delivery) ? null : false,['class'=>'custom-control-input']) !!}
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description">{{ $opt }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Trade In #2 </h4></div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_vin2','Last 6 VIN'); !!}
                                                            {!! Form::text('fld_trade_vin2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_stock2','Stock'); !!}
                                                            {!! Form::text('fld_trade_stock2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_acv2','Trade Value'); !!}
                                                            {!! Form::text('fld_trade_acv2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::label('fld_trade_year2','Trade Year'); !!}
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-calendar"></span>
                                                            </span>
                                                            {!! Form::text('fld_trade_year2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_make2','Make'); !!}
                                                            {!! Form::text('fld_trade_make2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_model2','Model'); !!}
                                                            {!! Form::text('fld_trade_model2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_colour2','Colour'); !!}
                                                            {!! Form::text('fld_trade_colour2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_mileage2','KM\'s'); !!}
                                                            {!! Form::text('fld_trade_mileage2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('trade_manager_acv2','Trade Manager ACV2'); !!}
                                                            {!! Form::text('trade_manager_acv2',isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_cylinder2','Engine'); !!}
                                                            {!! Form::select('fld_trade_cylinder2',[''=>'Choose One',4=>'4',6=>'6',8=>'8','other'=>'Other'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_transmission2','Transmission'); !!}
                                                            {!! Form::select('fld_trade_transmission2',[''=>'Choose One','Auto'=>'Auto','Manual'=>'Manual'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                        {{-- 'Auto'=>'Auto', --}}
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_drive2','Driveline'); !!}
                                                            {!! Form::select('fld_trade_drive2',[''=>'Choose One','FWD'=>'FWD','RWD'=>'RWD','AWD'=>'AWD','4X4'=>'4X4','4X2'=>'4X2'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_type2','Fuel Type'); !!}
                                                            {!! Form::select('fld_trade_type2',[''=>'Choose One','Gas'=>'Gas','Diesel'=>'Diesel','Hybrid'=>'Hybrid','Electric'=>'Electric'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_interior2','Interior'); !!}
                                                            {!! Form::select('fld_trade_interior2',[''=>'Choose One','Scrap'=>'Scrap','Dirty'=>'Dirty','Average'=>'Average','Clean'=>'Clean','Pin'=>'Pin'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 col-sm-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_trade_exterior2','Exterior'); !!}
                                                            {!! Form::select('fld_trade_exterior2',[''=>'Choose One','Scrap'=>'Scrap','Turd'=>'Turd','Average'=>'Average','Clean'=>'Clean','Pin'=>'Pin'],isset($delivery) ? null : '',["class"=>"form-control"]) !!}
                                                        </div>
                                                    </div>

                                                    @php
                                                        $trade_options = ['A','C','T','CD','PW','PL','SK','KE','START','RCAM','PS','L','HS','PR','ALL','CH','NAV','BLUE','DVD','VS','TOW'];
                                                    @endphp
                                                    @foreach($trade_options as $opt)
                                                        <div class="col-md-1 col-sm-1 col-xs-2 {{ $loop->first ? 'pr-0' : ($loop->last ? 'px-0' : 'pr-0' ) }}">
                                                            <fieldset>
                                                                <label class="custom-control custom-checkbox mr-0">
                                                                    {!! Form::checkbox('fld_trade_options2[]',$opt,isset($delivery) ? null : false,['class'=>'custom-control-input']) !!}
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description">{{ $opt }}</span>
                                                                </label>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </fieldset>


                                            <!-- Step 3 -->
                                            <h6>Financing</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Payment & Licence </h4></div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_customer','Name'); !!}
                                                            {!! Form::text('fld_customer',null,['class'=>'form-control required']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_payment','Payment'); !!}
                                                            {!! Form::select('fld_payment',$payments,null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-12 ">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_license','License') !!}
                                                            {!! Form::select('fld_license',[''=>'Select','New'=>'New','Trans'=>'Trans','Temp'=>'Temp'],null,["class"=>"form-control required"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-12 ">
                                                        <div class="form-group">
                                                            {!! Form::label('lisc_prep','LP') !!}
                                                            {!! Form::select('lisc_prep',['No'=>'No', 'Yes'=>'Yes'],null,["class"=>"form-control required"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-12 ">
                                                        <div class="form-group">
                                                            {!! Form::label('fld_rin','LB') !!}
                                                            {!! Form::select('fld_rin',['No'=>'No', 'Yes'=>'Yes'],null,["class"=>"form-control required"]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-xs-12 ">
                                                        <div class="form-group">
                                                            {!! Form::label('file_prep','FP') !!}
                                                            {!! Form::select('file_prep',['No'=>'No', 'Yes'=>'Yes'],null,["class"=>"form-control required"]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Details </h4></div>
                                                    @foreach(["NL"=>"New Lease","NF"=>"New Finance","NC"=>"New Cash","LOC"=>"Locate"] as $key=>$opt)
                                                        <div class="col-md-2 col-sm-4 col-xs-6">
                                                            <fieldset>
                                                                <label class="custom-control custom-checkbox">
                                                                    {!! Form::checkbox('fld_details[]',$key,null,['class'=>'custom-control-input']) !!}
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description">{{ $opt }}</span>
                                                                </label>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Protection </h4></div>
                                                    @foreach(["F.P.P","Paint","Rust","Sound","Glass","Tint x 2","Tint x 5","Interior"] as $opt)
                                                        <div class="col-md-2 col-sm-3 col-xs-6 ">
                                                            <fieldset>
                                                                <label class="custom-control custom-checkbox mr-0">
                                                                    {!! Form::checkbox('protection[]',$opt,isset($delivery) ? null : false,['class'=>'custom-control-input']) !!}
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description">{{ $opt }}</span>
                                                                </label>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Products </h4></div>
                                                    @foreach(["L","A","G","W","*L,A,G,W","LOE"] as $opt)
                                                    <div class="col-md-2 col-sm-3 col-xs-6 ">
                                                        <fieldset>
                                                            <label class="custom-control custom-checkbox mr-0">
                                                                {!! Form::checkbox('fld_products[]',$opt,isset($delivery) ? null : false,['class'=>'custom-control-input']) !!}
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description">{{ $opt }}</span>
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><h4 class="form-section"> Notes </h4></div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <div class="form-group">
                                                            {!! Form::textarea('fld_notes',null,["placeholder"=>"Notes",'class'=>"form-control",'rows'=>2]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with step validation section end -->
    </div>
    <style type="text/css">
        form .form-section{
            margin-bottom: 10px;
            margin-top: 10px;
            line-height: 1.5rem;
        }
        form .card-body {
            flex: 1 1 auto;
            padding: 5px;
        }
        .mb-2, .my-2 {
            margin-bottom: 5px !important;
        }
    </style>
@endsection

@push('vendor-css')
    {!! HTML::style('assets/css/bootstrap-extended.css') !!}
    {!! HTML::style('assets/css/colors.css') !!}
    {!! HTML::style('assets/vendors/css/components.css') !!}

    {!! HTML::style('assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css') !!}
    {!! HTML::style('assets/vendors/css/pickers/daterange/daterangepicker.css') !!}
    {!! HTML::style('assets/vendors/css/pickers/pickadate/pickadate.css') !!}
    {!! HTML::style('assets/css/plugins/forms/wizard.css') !!}
    {!! HTML::style('assets/css/plugins/pickers/daterange/daterange.css') !!}
@endpush

@push('page-vendor-js')
    {!! HTML::script('assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/pickadate/picker.date.js') !!}

    {!! HTML::script('assets/vendors/js/extensions/jquery.steps.min.js') !!}
    {!! HTML::script('assets/vendors/js/pickers/daterange/daterangepicker.js') !!}
    {!! HTML::script('assets/vendors/js/forms/validation/jquery.validate.min.js') !!}
@endpush

@section('scripts')
    <script type="text/javascript">
        // Show form
        var form = $(".steps-validation").show();

        $(".steps-validation").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: 'Submit'
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Forbid next action on "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age-2").val()) < 18)
                {
                    return false;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $('#delivery-form').submit();
            }
        });

        // Initialize validation
        $(".steps-validation").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'danger',
            successClass: 'success',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            rules: {
                email: {
                    email: true
                }
            }
        });

        $(document).ready(function(){
            $('#cancel-button').on('click',function(){
                swal({
                    title:'Are You Sure ?',
                    icon: "warning",
                    showCancelButton:true,
                    confirmButtonText:'Yes',
                },function(){
                    window.location.href = '{{ route('delivery-schedule',5) }}';
                })
            });

            $("#fld_sale_date").datetimepicker({format:'YYYY-MM-DD'});
            $("#fld_date").datetimepicker({format:'YYYY-MM-DD'});
            $("#fld_time").datetimepicker({format:'HH:mm:ss'});
            $("#fld_trade_year").datetimepicker({format:'YYYY'});
            $("#fld_trade_year2").datetimepicker({format:'YYYY'});
        })

        $('#cancel-button').on('click',function(){
            swal({
                title:'Are You Sure ?',
                icon: "warning",
                showCancelButton:true,
                confirmButtonText:'Yes',
            },function(){
                window.location.href = '{{ route('delivery-schedule',5) }}';
            })
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\DeliveryRequest', '#delivery-form') !!}
@endsection
