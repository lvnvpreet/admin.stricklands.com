@component('mail::message')
# Hi, {{ $transferRequest->user->full_name }}

{{ $message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
