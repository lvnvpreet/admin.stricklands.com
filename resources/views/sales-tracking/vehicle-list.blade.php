@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">
                {{ $location->fldLocationName }} Vehicle Sales
            </h3>
        </div>
    </div>
    <div class="content-body">
        <section id="sales-tracking">
            <div class="row">
                <div class="col-md-12">
                    @include('partials.messages')
                </div>
                @foreach(['new','used'] as $type)
                    @php
                        if(!$$type->count()) continue;

                        if( $location->id != 5 && $location->id != 8 && $location->id != 1 && $type == 'new' ){
                            continue;
                        }

                    @endphp
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @php
                                        $count = $total[$type]['complete'] + $total[$type]['pending'];
                                    @endphp
                                    @if(request()->has('emp_id') || $currentUser->details->fld_usr_cat == 3)
                                        @php
                                            $target = ($type == 'new') ? $employee->fld_new_target : $employee->fld_usr_target;
                                        $target = (int) $target;
                                        if(!$target) $target = 1;
                                        $percentage = round(($count/$target) * 100);
                                        @endphp
                                        @if(request()->has('funded') && request()->get('funded') == 'No' ) Pending @endif  {{ $count }} {{ $location->fldLocationName }} {{ ucfirst($type) }} Vehicles for {{ $employee->full_name }} | Target = {{ $target }} | {{ round((($count/$target) * 100)) }} % of New Target
                                    @else
                                        {{ $count }} {{ $location->fldLocationName }} {{ ucfirst($type) }} Vehicles @if(request()->has('funded') && request()->get('funded') == 'No' ) Pending @endif
                                        @php
                                            $target = ($type == 'new') ? $location->fldStoreNewTarget : $location->fldStoreTarget;
                                            $target = (int) $target;
                                            if(!$target) $target = 1;

                                            $percentage = round(($count/$target) * 100);
                                        @endphp
                                    @endif
                                </h4>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress">
                                                <div class="progress-bar {{ ($percentage < 95) ? (($percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($percentage,0) }}" aria-valuemin="{{ round($percentage,0) }}" aria-valuemax="100" style="width:{{ round($percentage,0) }}%; max-width: 100%">{{ round($percentage,0) }}%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable">
                                                <thead>
                                                <tr><?php $vehicle = "12454"; ?>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col" class="text-center">Status</th>
                                                    <th scope="col" class="text-center">Stock #</th>
                                                    <th scope="col" class="text-center">Vehicle</th>
                                                    <th scope="col" class="text-center">Customer</th>
                                                    <th scope="col" class="text-center">Sales</th>
                                                    <th scope="col" class="text-center">Split</th>
                                                    <th scope="col" class="text-center">Del. Date</th>
                                                    <th scope="col" class="text-center">Del. Time</th>
                                                    <th scope="col" class="text-center">Delivered</th>
                                                    <th scope="col" class="text-center">Funded</th>
                                                    @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('superadmin'))
                                                        <th scope="col" class="text-center">E</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($$type as $vehicle)
                                                    @php
                                                        $quantity_new = 1;
                                                        if(request()->has('emp_id') ){
                                                            if($vehicle->fld_sperson2 > "5") $quantity_new = 0.5;
                                                            if($vehicle->fld_spare > "Yes") $quantity_new = 0;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $quantity_new }}</th>
                                                        <td class="text-center">
                                                            <img src="/assets/img/fugue/{{ ($vehicle->fld_on_service == 'Yes') ? 'tick' : 'cross' }}-circle.png" width="14" height="12"  class="lens" />
                                                        </td>
                                                        <td class="text-center">{{ $vehicle->fld_stock }}</td>
                                                        <td>
                                                            @if($vehicle->fld_stock != 'INCOMING')
                                                                <a data-fancybox data-type="ajax" data-src="{{ route('inventory.list.popup',$vehicle->fld_stock) }}">
                                                                    {{ str_limit($vehicle->fld_year . " " . $vehicle->fld_make . " " . $vehicle->fld_model,25) }}
                                                                </a>
                                                            @else
                                                                {{ str_limit($vehicle->fld_year . " " . $vehicle->fld_make . " " . $vehicle->fld_model,25) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ str_limit($vehicle->fld_customer,15) }}
                                                        </td>
                                                        <td>{{ str_limit($vehicle->saleperson->full_name,15) }}</td>
                                                        <td>{{ str_limit(@$vehicle->saleperson2->full_name,15) }}</td>
                                                        <td>{{ date('D-M-d',strtotime($vehicle->fld_date)) }} </td>
                                                        <td>{{ date('g:i A',strtotime($vehicle->fld_time)) }} </td>
                                                        <td class="text-center">
                                                            <img src="/assets/img/fugue/{{ ($vehicle->fld_hdn == 'Yes') ? 'tick' : 'cross' }}-circle.png" width="14" height="12"  class="lens" />
                                                        </td>
                                                        <td class="text-center">
                                                            <img src="/assets/img/fugue/{{ ($vehicle->fld_funded == 'Yes') ? 'tick' : 'cross' }}-circle.png" width="14" height="12"  class="lens" />
                                                        </td>
                                                        @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('superadmin'))
                                                            <td>
                                                                <a href="{{ route('delivery-schedule-edit',['delivery'=>$vehicle->id]) }}">
                                                                <i class="fa fa-pencil"></i></a>
                                                            </td>
                                                        @endif
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
                @endforeach
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
@stop
