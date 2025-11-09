
<div class="panel-heading">
    <div class="row">
        <div class="col col-xs-6">
            <h2 class="panel-title">Guest Tracking</h2>
        </div>
        <div class="col col-xs-6 text-right">

        </div>
    </div>
</div>
<div class="panel-body">
    <table class="table table-striped table-bordered">
        <thead>
            <th style="display: none;">#</th>
            <th>Location</th>
            <th>Guest Name</th>
            <th>City</th>
            <th>Type</th>
            <th>Used/New</th>
            <th>Arrival Time</th>
        </thead>

        <tbody>
        @if(isset($history) && count($history))
            @foreach ($history as $item)
                <tr>
                    <td style="display: none;">{{ $loop->iteration }}</td>
                    <td>{{ $item->location->fldLocationName }}</td>
                    <td>{{ $item->guest_name }}</td>
                    <td>{{ $item->guest_city }}</td>
                    <td>{{ $item->type->name }}</td>
                    <td>{{ $item->guest_used_new }}</td>
                    <td>{{ $item->arrival_time }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12"><em>@lang('app.no_records_found')</em></td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
