@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">
                {{ $stricklandTarget->fldLocationName }} Tracker - Day {{ $stricklandTarget->day_num }} of {{ $stricklandTarget->days_total }} Selling Days
                @if($type == 'funded')
                    Delivered &amp; Funded to be Posted
                @elseif($type == 'posted')
                    Finalized & Posted
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-responsive-lg table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><i class="fas fa-road"></i></th>
                                                    <th scope="col" class="text-center">Used</th>
                                                    <th scope="col" class="text-center">Percentage of Target</th>
                                                    <th scope="col" class="text-center">{{ ($type == 'funded') ? 'Funded' : 'Posted' }}</th>
                                                    <th scope="col" class="text-center">Target</th>
                                                    <th scope="col" class="text-center">% of Target</th>
                                                    <th scope="col" class="text-center">Extended</th>
                                                    <th scope="col" class="text-center">Projection</th>
                                                    <th scope="col" class="text-center">{{ ($type == 'funded') ? 'Pending' : 'Funded' }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$automart->id]) }}">
                                                            {{ $automart->fldShortName }} Used
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($automart_percentage < 95) ? (($automart_percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $automart_percentage }}" aria-valuemin="{{ $automart_percentage }}" aria-valuemax="100" style="width:{{ $automart_percentage }}%; max-width: 100%">{{ $automart_percentage }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $automart_retail_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $automart->fldStoreTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($automart_retail_del/$automart->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $automart_extended = round($automart_retail_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($automart_extended/$automart->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center"> {{ $automart_retail_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$toyata->id]) }}">
                                                            {{ $toyata->fldShortName }} Used
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($toyota_percentage < 95) ? (($toyota_percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $toyota_percentage }}" aria-valuemin="{{ $toyota_percentage }}" aria-valuemax="100" style="width:{{ $toyota_percentage }}%; max-width: 100%">{{ $toyota_percentage }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyota_used_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyata->fldStoreTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyata->fldStoreTarget ? round(($toyota_used_del/$toyata->fldStoreTarget) * 100) : '0' }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyota_used_extended = round($toyota_used_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyata->fldStoreTarget ? round(($toyota_used_extended/$toyata->fldStoreTarget) * 100) : '0' }} %
                                                    </td>
                                                    <td class="text-center"> {{ $toyota_used }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_total = $automart_retail_del + $toyota_used_del }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_target = $automart->fldStoreTarget + $toyata->fldStoreTarget }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_percent = round(($used_stratford_total/$used_stratford_target) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_extended = round($toyota_used_extended)+round($automart_extended)    }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_extended_percent = round(($used_stratford_extended/$used_stratford_target) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $stratford_pending = $automart_retail_sold + $toyota_used }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$windsor->id]) }}">
                                                            {{ $windsor->fldShortName }} Used
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($windsor_percentage < 95) ? (($windsor_percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $windsor_percentage }}" aria-valuemin="{{ $windsor_percentage }}" aria-valuemax="100" style="width:{{ $windsor_percentage }}%; max-width: 100%">{{ $windsor_percentage }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $windsor_retail_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $windsor->fldStoreTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($windsor_retail_del/$windsor->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $windsor_used_extended = round($windsor_retail_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($windsor_used_extended/$windsor->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center"> {{ $windsor_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$brantford->id]) }}">
                                                            {{ $brantford->fldShortName }} Used
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($brantford_percentage < 95) ? (($brantford_percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $brantford_percentage }}" aria-valuemin="{{ $brantford_percentage }}" aria-valuemax="100" style="width:{{ $brantford_percentage }}%; max-width: 100%">{{ $brantford_percentage }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford_retail_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford->fldStoreTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($brantford_retail_del/$brantford->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford_used_extended = round($brantford_retail_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($brantford_used_extended/$brantford->fldStoreTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center"> {{ $brantford_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center text-bold-700"> {{ $used_other = $windsor_retail_del + $brantford_retail_del }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_other_target = $windsor->fldStoreTarget + $brantford->fldStoreTarget }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_other_percent = round(($used_other/$used_other_target) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $used_other_extended = round($windsor_used_extended)+round($brantford_used_extended)    }}</td>
                                                    <td class="text-center text-bold-700"> {{ $used_other_extended_percent = round(($used_other_extended/$used_other_target) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $used_other_pending = $windsor_sold + $brantford_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$toyata->id]) }}">
                                                            {{ $toyata->fldShortName }} New
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($toyota_new_percentage < 95) ? (($toyota_new_percentage >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $toyota_new_percentage  }}" aria-valuemin="{{ $toyota_new_percentage  }}" aria-valuemax="100" style="width:{{ $toyota_new_percentage  }}%; max-width: 100%">{{ $toyota_new_percentage  }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyota_new_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyata->fldStoreNewTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($toyota_new_del/$toyata->fldStoreNewTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $toyota_new_extended = round($toyota_new_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($toyota_new_extended/$toyata->fldStoreNewTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center"> {{ $toyota_new_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-hand-point-up"></i></td>
                                                    <td>
                                                        <a href="{{ route('sales-tracking',['location'=>$brantford->id]) }}">
                                                            {{ $brantford->fldShortName }} Used
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ ($brantford_new_percentage < 95) ? (($brantford_new_percentage  >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ $brantford_new_percentage  }}" aria-valuemin="{{ $brantford_new_percentage  }}" aria-valuemax="100" style="width:{{ $brantford_new_percentage  }}%; max-width: 100%">{{ $brantford_new_percentage  }}%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford_new_del }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford->fldStoreNewTarget }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($brantford_new_del/$brantford->fldStoreNewTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $brantford_new_extended = round($brantford_new_del*$used_extended_var) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ round(($brantford_new_extended/$brantford->fldStoreNewTarget) * 100) }} %
                                                    </td>
                                                    <td class="text-center"> {{ $brantford_new_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center text-bold-700"> {{ $new_delivered = $windsor_retail_del + $brantford_retail_del }}</td>
                                                    <td class="text-center text-bold-700"> {{ $new_targets = $toyata->fldStoreNewTarget + $brantford->fldStoreNewTarget }}</td>
                                                    <td class="text-center text-bold-700"> {{ $new_percent_target = round(($new_delivered/$new_targets) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $new_extended_total = round($toyota_new_extended)+round($brantford_new_extended)    }}</td>
                                                    <td class="text-center text-bold-700"> {{ $new_extended_percent = round(($new_extended_total/$new_targets) * 100) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $new_pending = $toyota_new_sold + $brantford_new_sold }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td colspan="8">
                                                        <a href="{{ url('sales-tracking/5/vehicles') }}?fleet=Yes">Toyota Fleet = {{ $stratford_fleet }}</a>&nbsp;|&nbsp;
                                                        <a href="{{ url('sales-tracking/8/vehicles') }}?fleet=Yes">Brantford Fleet = {{ $brantford_fleet }}</a>&nbsp;|&nbsp;
                                                        <a href="{{ url('sales-tracking/1/vehicles') }}?wholesale=Yes">Automart Wholesale = {{ $automart_wholesale }}</a>&nbsp;|&nbsp;
                                                        <a href="{{ url('sales-tracking/2/vehicles') }}?wholesale=Yes">Windsor Wholesale = {{ $windsor_wholesale }}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><b>Totals</b></td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_total + $used_other + $new_delivered }} </td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_target + $used_other_target + $new_targets }}</td>
                                                    <td class="text-center text-bold-700"> {{ round(($used_stratford_percent + $used_other_percent + $new_percent_target)/3) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $used_stratford_extended + $used_other_extended + $new_extended_total }}</td>
                                                    <td class="text-center text-bold-700"> {{ round(($used_stratford_extended_percent + $used_other_extended_percent + $new_extended_percent) / 3) }} % </td>
                                                    <td class="text-center text-bold-700"> {{ $stratford_pending + $used_other_pending + $new_pending }}</td>
                                                </tr>
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
@endsection

