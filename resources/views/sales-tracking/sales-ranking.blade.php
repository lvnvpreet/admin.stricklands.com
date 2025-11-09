@extends('layouts.app')

@section('content')
    <div class="content-header row mb-1">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Sales Ranking</h3>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">MONTHLY SALES RANKINGS</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-hover table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th><b>Rank</b></th>
                                        <th><b>Name</b></th>
                                        <th><b>Location</b></th>
                                        <th><b>Funded</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesman as $sales)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sales->full_name }}</td>
                                            <td>{{ $sales->location->fldLocationName }}</td>
                                            <td>{{ $sales->rank }}</td>
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
@stop
