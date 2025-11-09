@extends('layouts.app')

@section('page-title', 'Manage Locations'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Update Location</h3>
        </div>
    </div>

@include('partials.messages')


<div class="content-body">
    <section id="open-tickets">
        <div class="row">
            @include('partials.messages')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::model($location,['route'=>['location.update',$location->id],'id'=>'uploadLocation']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldLocationName','Location Name') !!}
                                                    {!! Form::text('fldLocationName',NULL,['class'=>'form-control border-primary','placeholder'=>"Location name"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldShortName','Location Short Name') !!}
                                                    {!! Form::text('fldShortName',NULL,['class'=>'form-control border-primary','placeholder'=>"Location short name"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldCode','Location Code') !!}
                                                    {!! Form::text('fldCode',NULL,['class'=>'form-control border-primary','placeholder'=>"Location code"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldStoreTarget','Location Target') !!}
                                                    {!! Form::number('fldStoreTarget',NULL,['class'=>'form-control border-primary','placeholder'=>"Location target"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldStoreNewTarget','New Target') !!}
                                                    {!! Form::number('fldStoreNewTarget',NULL,['class'=>'form-control border-primary','placeholder'=>"New target"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldPhone','Phone') !!}
                                                    {!! Form::text('fldPhone',NULL,['class'=>'form-control border-primary','placeholder'=>"Phone"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldAddress','Address') !!}
                                                    {!! Form::text('fldAddress',NULL,['class'=>'form-control border-primary','placeholder'=>"Address"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldPostal','Postal') !!}
                                                    {!! Form::text('fldPostal',NULL,['class'=>'form-control border-primary','placeholder'=>"Postal"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldWebSite','Website') !!}
                                                    {!! Form::text('fldWebSite',NULL,['class'=>'form-control border-primary','placeholder'=>"Website"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('day_start','Day Start') !!}
                                                    {!! Form::text('day_start',NULL,['class'=>'form-control border-primary','placeholder'=>"Day Start"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('day_end','Day End') !!}
                                                    {!! Form::text('day_end',NULL,['class'=>'form-control border-primary','placeholder'=>"Day End"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('day_num','Number Of Days') !!}
                                                    {!! Form::number('day_num',NULL,['class'=>'form-control border-primary','placeholder'=>"Number of days"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('days_total','Total Days') !!}
                                                    {!! Form::number('days_total',NULL,['class'=>'form-control border-primary','placeholder'=>"Total days"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('fldLocationOrder','Location Order') !!}
                                                    {!! Form::number('fldLocationOrder',NULL,['class'=>'form-control border-primary','placeholder'=>"Location order"]) !!}
                                                </div>
                                            </div>
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
</div>
@stop
