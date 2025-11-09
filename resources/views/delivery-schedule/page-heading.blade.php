<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">{{ count($deliveries) }} <b>{{ $location->fldLocationName }}</b> Deliveries @if(request()->has('date')) on {{ request()->date }}  @endif</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('delivery-schedule',[$location->id]) }}?view=f">Full Screen Version</a></li>
                    @permission('delivery.manage')
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('delivery-schedule-service',[$location->id]) }}">Service</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('delivery-schedule-detail',[$location->id]) }}">Detail</a></li>
                    @endpermission
                    <li class="breadcrumb-item"><a target="_blank" href="{{ url('delivery-schedule/co-ordinator/'.$location->id) }}?date={{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">Co-ordinator</a></li>
                    @permission('delivery.manage')
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('delivery-schedule-add') }}">Add Delivery</a></li>
                    @endpermission
                </ol>
            </div>
        </div>
    </div>
</div>
