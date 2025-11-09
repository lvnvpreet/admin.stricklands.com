@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">{{ $location->fldLocationName }} Tracker - Day {{ $stricklandTarget->day_num }} of {{ $stricklandTarget->days_total }} Selling Days
                @if($CurrentUser->fld_usr_level != '' && $CurrentUser->fld_usr_level <= 4)
                    <a href="#edit-date-range" data-toggle="modal"><i data-toggle="tooltip" title="Edit Date Range" class="ft ft-calendar"></i></a>
                    <a href="#edit-location-target" data-toggle="modal"><i data-toggle="tooltip" title="Edit Location Target" class="ft ft-edit"></i></a>
                @endif
            </h3>
        </div>
    </div>
    <div class="content-body">
        <section id="sales-tracking">
            <div class="row">
                <div class="col-md-12">
                    @include('partials.messages')
                </div>
                @php $extGrndTotal = 0 @endphp
                @foreach(['new','used'] as $type)
                    @php
                        if( $location->id != 5 && $location->id != 8 && $location->id != 1 && $type == 'new' ){
                            continue;
                        }
                    @endphp
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <div class="row">
                                        @php
                                            $locationTarget = ($type == 'new') ? $location->fldStoreNewTarget : $location->fldStoreTarget;
                                            
                                            if(!$locationTarget) $locationTarget = 1;
                                            $percentage = ($data[$type]['total']/$locationTarget) * 100;
                                            $new_extended_var = $stricklandTarget->days_total/$stricklandTarget->day_num;
                                            $extended_total = 0;
                                        @endphp
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="alert {{ ($percentage < 95) ? (($percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="alert">
                                                {{ ucfirst($type) }} Target = <strong>{{ $locationTarget }}</strong> | Tracking <strong>{{ $locationTarget - $data[$type]['total'] }}</strong> Units Below Target | We need <strong>{{ round($locationTarget/$stricklandTarget->days_total,2) }}</strong> sales per Day to accompish our goal. | Current Sales per Day = <strong>{{ round($data[$type]['total']/$stricklandTarget->days_total,2) }}</strong> | <strong>{{ round($percentage,0) }}%</strong> of target.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="progress">
                                                <div class="progress-bar {{ ($percentage < 95) ? (($percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($percentage,0) }}" aria-valuemin="{{ round($percentage,0) }}" aria-valuemax="100" style="width:{{ round($percentage,0) }}%; max-width: 100%">{{ round($percentage,0) }}%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                <table class="table table-bordered table-responsive-lg table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" class="text-center">{{ ucfirst($type) }}</th>
                                                        <th scope="col" class="text-center">Funded</th>
                                                        @if ($type == "used")
                                                            <th scope="col" class="text-center">Buys</th>
                                                        @endif
                                                        <th scope="col" class="text-center">Target</th>
                                                        <th scope="col" class="text-center">% of Target</th>
                                                        <th scope="col" class="text-center">Extended</th>
                                                        <th scope="col" class="text-center">Projection</th>
                                                        <th scope="col" class="text-center">Pending</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data[$type]['users'] as $user_id=>$totalSale)
                                                            @php
                                                                $user = $users->where('id',$user_id)->first();
                                                                if(is_null($user) || ($totalSale==0 && $pendingData[$type]['users'][$user->id]==0)) continue; //skip if user not found
                                                                if(!$user->fld_new_target){
                                                                    $user->fld_new_target = 1;
                                                                }
                                                                if(!$user->fld_usr_target){
                                                                    $user->fld_usr_target = 1;
                                                                }
    
                                                                $user_target = ($type == 'used') ? $user->fld_usr_target : $user->fld_new_target;
    
                                                                $uPercent = ($totalSale/$user_target) * 100;
                                                                $extend = $totalSale * $new_extended_var;
                                                                $uProjected = ($extend/$user_target) * 100;
    
                                                            @endphp
                                                            <tr>
                                                                <th scope="row"><i class="fa fa-user"></i></th>
                                                                <td class="text-center">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <a href="{{ route('sales-tracking-list',['location'=>$location->id]) }}?emp_id={{ $user->id }}">
                                                                                {{ $user->full_name }}
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="progress">
                                                                                <div class="progress-bar {{ ($uProjected < 100) ? (($uProjected >= 80) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($uPercent,0) }}" aria-valuemin="100" aria-valuemax="100" style="width:100%; max-width: 100%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{ $totalSale }}</td>
                                                                @if ($type == "used")
                                                                    <td class="text-center"> 
                                                                        @if(isset($data[$type]['buys'][$user_id]) && $data[$type]['buys'][$user_id] > 0)
                                                                            {{ $data[$type]['buys'][$user_id] }} 
                                                                        @else 
                                                                            0 
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                                <td class="text-center">
                                                                    {{ $user_target }}
                                                                    @if($CurrentUser->fld_usr_level != '' && $CurrentUser->fld_usr_level <= 4)
                                                                        <a href="#edit-person-target" data-id="{{ $user->id }}" data-name="{{ $user->full_name }}" data-used="{{ $user->fld_usr_target }}" data-new="{{ $user->fld_new_target }}" data-toggle="modal"><i data-toggle="tooltip" title="Edit {{ $user->full_name }} Target" class="fa fa-pencil"></i></a>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center"> {{ round($uPercent,0) }} %</td>
                                                                <td class="text-center">{{  number_format($extend,1) }}</td>
                                                                <td class="text-center">{{ round(($extend/$user_target) * 100) }} % </td>
                                                                <td class="text-center">{{ $pendingData[$type]['users'][$user->id] }}</td>
                                                            </tr>
                                                            @php $extended_total += round($extend);  @endphp
                                                        @endforeach
                                                        @if(!is_null($house))
                                                            @php
                                                                if(!$house->fld_new_target){
                                                                    $house->fld_new_target = 1;
                                                                }
                                                                if(!$house->fld_usr_target){
                                                                    $house->fld_usr_target = 1;
                                                                }
    
                                                                $houseTarget = ($type == 'used') ? $house->fld_usr_target : $house->fld_new_target;
                                                            @endphp
                                                            <tr>
                                                                <th scope="row"><i class="fa fa-user"></i></th>
                                                                <td>
                                                                    @if($CurrentUser->fld_usr_level != '' && $CurrentUser->fld_usr_level <= 4)
                                                                        <a href="{{ route('sales-tracking-list',['location'=>$location->id]) }}?emp_id={{ $house->id }}">
                                                                            {{ $house->full_name }}
                                                                        </a>
                                                                    @else
                                                                        {{ $house->full_name }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ isset($data[$type]['users'][$house->id]) ? $data[$type]['users'][$house->id] : 0 }}
                                                                </td>
                                                                @if ($type == "used")
                                                                    <td class="text-center"> 
                                                                        @if(isset($data[$type]['buys'][$user_id]) && $data[$type]['buys'][$user_id] > 0)
                                                                            {{ $data[$type]['buys'][$user_id] }} 
                                                                        @else 
                                                                            0
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                                <td class="text-center">
                                                                    {{ $house->fld_new_target }}
                                                                    @if($CurrentUser->fld_usr_level != '' && $CurrentUser->fld_usr_level <= 4)
                                                                        <a href="#edit-person-target" data-toggle="modal"><i data-toggle="tooltip" title="Edit {{ $house->full_name }}'s Target" class="fa fa-pencil"></i></a>
                                                                    @endif
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td class="text-center">
                                                                    {{ isset($pendingData[$type]['users'][$house->id]) ? $pendingData[$type]['users'][$house->id] : 0 }}
                                                                </td>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                @if($CurrentUser->fld_usr_level != '' && $CurrentUser->fld_usr_level <= 4)
                                                                    <strong>
                                                                        <a href="{{ route('sales-tracking-list',['location'=>$location->id]) }}?funded=Yes">
                                                                            Delivered
                                                                        </a>
                                                                    </strong> |
                                                                    <strong>
                                                                        <a href="{{ route('sales-tracking-list',['location'=>$location->id]) }}?funded=No">
                                                                            Pending
                                                                        </a>
                                                                    </strong>
                                                                @endif
                                                            </td>
                                                            <td class="text-center"><strong>{{ $data[$type]['total'] }}</strong></td>
                                                            
                                                            @if ($type == "used")
                                                                <td class="text-center">{{ $data['buys']['total'] }}</td>
                                                            @endif
                                                            <td class="text-center"><strong>{{ $locationTarget }}</strong></td>
                                                            <td class="text-center"><strong>{{ round($percentage) }} %</strong></td>
                                                            <td class="text-center"><strong>{{ $extended_total }}</strong></td>
                                                            <td class="text-center"><strong>{{ round(($extended_total/$locationTarget) * 100) }} %</strong></td>
                                                            <td class="text-center"><strong>{{ $pendingData[$type]['total'] }}</strong></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @php $extGrndTotal += $extended_total @endphp
                @endforeach
                @if($location->id!=2)
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-md-12 pt-1">
                            <table class="table table-bordered table-responsive-lg text-center">
                                <tr>
                                    <th style="border-bottom-color: #fff">New + Used</th>
                                    <th>Funded</th>
                                    <th>Target</th>
                                    <th>% of Target</th>
                                    <th>Extended</th>
                                    <th>Projection</th>
                                    <th>Pending</th>
                                </tr>
                                <tr>
                                    <td><b>Totals</b></td>
                                    <td>{{ $totalFunded = $data['new']['total'] + $data['used']['total'] }}</td>
                                    <td>{{ $totalTtarget =  $location->fldStoreNewTarget + $location->fldStoreTarget }}</td>
                                    <td> @if($totalFunded > $totalTtarget) {{ round(($totalFunded/$totalTtarget) * 100) }} @else 0 @endif % </td>
                                    <td> {{ round($extGrndTotal) }} </td>
                                    <td>@if($extGrndTotal > $totalTtarget) {{ round(($extGrndTotal/$totalTtarget) * 100) }} @else 0 @endif % </td>
                                    <td>{{ $totalFunded = $pendingData['new']['total'] + $pendingData['used']['total'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
    @include('sales-tracking.edit-date-range')
@endsection

