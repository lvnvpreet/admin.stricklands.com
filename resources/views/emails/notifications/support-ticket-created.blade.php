@component('mail::message')
# Support Ticket #{{ $ticket->id }}

A new support ticket is raised by <b>{{ $ticket->user->full_name }}</b> on <b>{{ $ticket->created_at->format('j M, Y @ h:i a') }}</b>

@component('mail::table')
    |                                Support Ticket #{{ $ticket->id }}                  |
    | ------------------------- |:-----------------------------------------------------:|
    | <b>Ticket ID </b>         | {{ $ticket->id }}                                     |
    | <b>Date Submitted</b>     | {{ $ticket->created_at->format('j M, Y @ h:i a') }}   |
    | <b>Name</b>               | {{ $ticket->user->full_name }}                        |
    | <b>Email</b>              | {{ $ticket->user->email }}                            |
    | <b>Support Category</b>   | {{ $ticket->category->name }}                         |
    | <b>Priority</b>           | {{ $ticket->priority }}                               |
    | <b>Ticket Subject</b>     | {{ $ticket->subject }}                                |
    | <b>Message</b>            | {{ $ticket->message }}                                |
    | <b>Assigned</b>           | {{ $ticket->assignedTo->full_name ?? "NA" }}          |
@endcomponent

@component('mail::button', ['url' => route('support-ticket.view',[$ticket->id])])
    View Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
