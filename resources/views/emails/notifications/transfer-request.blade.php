@component('mail::message')
# New Transfer Request

A new vehicle transfer request is submitted by <b>{{ $transferRequest->user->full_name }}</b> on <b>{{ date('j M, Y',strtotime($transferRequest->crnt_date)) }}</b> at {{ date('h:i a',strtotime($transferRequest->crnt_time)) }}

@component('mail::table')
    |                              Request Detail                                   |
    | ------------------------- |:-------------------------------------------------:|
    | <b>Current Location</b>   | {{ $transferRequest->current_location }}          |
    | <b>Transfer Location</b>  | {{ $transferRequest->transfer_location }}         |
    | <b>Transfer Date</b>      | {{ $transferRequest->transfer_date }}             |
    | <b>Transfer Time</b>      | {{ $transferRequest->transfer_time }}             |
    | <b>Transfer Method</b>    | {{ $transferRequest->transfer_method }}           |
    | <b>Transfer Method</b>    | {{ $transferRequest->driverUser->full_name }}     |
@endcomponent

@component('mail::button', ['url' => route('vehicle-logistics.pen-transfer')])
View Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
