@extends('layouts.app')

@section('page-title', 'Manage Locations'))

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Manage Locations</h3>
        </div>
    </div>

@include('partials.messages')


<div class="content-body">
    <section id="open-tickets">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <table id="table" class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable">
                                            <thead>
                                            <tr>
                                                <th>Location Name</th>
                                                <th>Short Name</th>
                                                <th>Code</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($locations as $location)
                                                <tr>
                                                    <td>{{ $location->fldLocationName }}</td>
                                                    <td>{{ $location->fldShortName }}</td>
                                                    <td>{{ $location->fldCode }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('location.edit',$location->id) }}" class="btn btn-primary btn-circle"
                                                           title="Edit Location" data-toggle="tooltip" data-placement="top">
                                                            <i class="glyphicon glyphicon-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

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
