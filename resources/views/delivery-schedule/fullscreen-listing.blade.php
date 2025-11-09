@extends('layouts.one-column-layout')

@push('page-title'){{ $location_title }} - Delivery Schedule - @endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Delivery Schedule for {{ $location_title }}</h3>
        </div>
    </div>
    <div class="content-body">
    <!-- Description -->
    <div class="card">
        <div class="card-content">
            <div class="">
                <table width="100%" class="table table table-bordered mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th width="2%">OK</th>
                        <th width="2%">GO</th>
                        <th width="10%">CUSTOMER</th>
                        <th width="20%">VEHICLE</th>
                        <th width="15%">VIN</th>
                        <th width="5%">STK#</th>
                        <th width="5%">DATE</th>
                        <th width="5%">TIME</th>
                        <th width="5%">PROT</th>
                        <th width="5%">PRODUCTS</th>
                        <th width="5%">PAYMENT</th>
                        <th width="5%">LISC.</th>
                        <th width="5%">SALES</th>
                        <th width="2%">FP</th>
                        <th width="2%">LP</th>
                        <th width="2%">LB</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($deliveries))
                            @foreach($deliveries as $delivery)
                                <tr style="background-color: {{ $delivery->tbl_bg_color }}">
                                    <td w nowrap scope="row"  class="text-center">
                                        @if($delivery->fld_pend == 'Yes')
                                            <img src="/assets/img/fugue/clock.png" width="16" height="16"  class="lens" />
                                        @elseif($delivery->fld_status == 'Alert')
                                            <img src="/assets/img/fugue/flag-bright.png" width="20" height="20"  class="lens" />
                                        @elseif($delivery->fld_status == 'OK')
                                            <img src="/assets/img/fugue/tick-circle-faded.png" width="14" height="12"  class="lens" />
                                        @else
                                            <img src="/assets/img/fugue/cross-circle-faded.png" width="14" height="12"  class="lens" />
                                        @endif
                                    </td>
                                    <td nowrap>
                                        @if($delivery->d_complete == "Yes" && $delivery->s_safe == "Yes" && $delivery->s_emmision == "Yes")
                                            <img src="{{ asset('/assets/img/fugue/tick-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                        @else
                                            <img src="{{ asset('/assets/img/fugue/cross-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                        @endif
                                    </td>
                                    <td nowrap @if($delivery->fld_notes != "" || $delivery->fld_status == "Alert" )
                                        data-toggle="tooltip"
                                        data-html="true"
                                        data-placement="right"
                                        title="@if($delivery->fld_status == "Alert")
                                                <b>{{ wordwrap($delivery->al_notes) }}</b> <br/>
                                                    @endif {{ wordwrap($delivery->fld_notes,22,"<br/>\n") }}
                                                "
                                            @endif
                                    > {{-- tr closed --}}
                                        {{ str_limit($delivery->fld_customer,15) }} {{ ($delivery->fld_notes != "" || $delivery->fld_status == "Alert") ? "*" : "" }}
                                    </td>
                                    <td nowrap>
                                        @if($delivery->fld_stock != 'INCOMING')
                                            <a target="_blank" href="{{ route('vehicle-details',$delivery->fld_stock) }}">
                                                {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}
                                            </a>
                                        @else
                                            {{ str_limit($delivery->fld_year . " " . $delivery->fld_make . " " . $delivery->fld_model,25) }}

                                        @endif
                                    </td>
                                    <td nowrap> {{ $delivery->fld_vin }}</td>
                                    <td>{{ $delivery->fld_stock }}</td>
                                    <td nowrap>{{ date('D-M-d',strtotime($delivery->fld_date)) }}</td>
                                    <td nowrap>{{ date('g:i A',strtotime($delivery->fld_time)) }}</td>
                                    <td nowrap>{{ implode(',',(array) $delivery->protection) }}</td>
                                    <td nowrap>{{ implode(',',(array) $delivery->products) }}</td>
                                    <td nowrap @if($delivery->fld_payment != 'CASH' && $delivery->fld_payment != 'OTHER')
                                                data-toggle="tooltip"
                                                data-html="true"
                                                data-placement="right"
                                                title="{{ $delivery->payment->product . "<br/>" . $delivery->payment->address . "<br/>" . $delivery->payment->city . "," . $delivery->payment->prov . "<br/>" . $delivery->payment->postal }}
                                                "
                                               @endif
                                        >{{ $delivery->fld_payment }}@if($delivery->fld_payment != 'CASH' && $delivery->fld_payment != 'OTHER')*@endif</td>
                                    <td nowrap>{{ $delivery->fld_license }}</td>
                                    <td nowrap>{!! $delivery->saleperson->full_name !!}</td>
                                    <td nowrap>
                                        <img src="{{ asset('/assets/img/fugue/' . (($delivery->file_prep == "Yes") ? 'tick' : 'cross') . '-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                    </td>
                                    <td nowrap>
                                        <img src="{{ asset('/assets/img/fugue/' . (($delivery->lisc_prep == "Yes") ? 'tick' : 'cross') . '-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                    </td >
                                    <td nowrap>
                                        <img src="{{ asset('/assets/img/fugue/' . (($delivery->fld_rin == "Yes") ? 'tick' : 'cross') . '-circle-faded.png') }}" width="14" height="12"  class="lens" />
                                    </td>
                                </tr>
                                @if($delivery->fld_notes || $delivery->al_notes)
                                <tr style="background-color: {{ $delivery->tbl_bg_color }}">
                                    <td colspan="16">
                                        @if($delivery->fld_status == 'Alert' && $delivery->al_notes)
                                            ALERT NOTES : {{ $delivery->al_notes }} |
                                        @endif NOTES: {{ $delivery->fld_notes }}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @else
                            <tr >
                                <td colspan="16">There are no delivery schedule for this location.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Description -->
</div>
    <style>
        .table th, .table td{
            padding: 0.75rem;
        }
    </style>
@endsection
