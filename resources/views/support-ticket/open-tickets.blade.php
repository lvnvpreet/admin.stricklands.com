@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header left mb-2 col-12 col-md-6">
            <h3 class="content-header-title mb-0">Your Open Tickets</h3>
        </div>
        @cannot('has-role','Admin|superadmin')
        <div class="content-header-right col-md-6 col-12">
            <div role="group" class="btn-group float-md-right">
                <div role="group" class="btn-group">
                    <a href="{{ route('support-ticket.add') }}" class="btn btn-outline-primary "><i class="fas fa-plus-circle"></i> Add a ticket</a>
                </div>
            </div>
        </div>
        @endcannot
    </div>
    <div class="content-body">
        <section id="open-tickets">
            <div class="row">
                @include('partials.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Open Tickets</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($tickets->count())
                                            <table class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Category</th>
                                                        <th>Message</th>
                                                        <th>Priority</th>
                                                        <th>Submitted Date</th>
                                                        <th>Assigned To</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tickets as $ticket)
                                                    <tr id="tr-{{ $ticket->id }}">
                                                        <td>{{ $ticket->subject }}</td>
                                                        <td>{{ $ticket->category->name }}</td>
                                                        <td
                                                                @if(strlen($ticket->message) > 25)
                                                                data-toggle="popover"
                                                                data-content="{{ $ticket->message }}"
                                                                @endif
                                                        >{{ str_limit($ticket->message,25) }}</td>
                                                        <td>{{ $ticket->priority }}</td>
                                                        <td>{{ $ticket->created_at->format('j M, Y @ h:i a') }}</td>
                                                        <td>@foreach($ticket->users()->get() as $user)
                                                        {{ $user->first_name }} ({{ $user->email }})<br>
                                                    @endforeach</td>
                                                        <td>
                                                            @if(!$ticket->is_closed)
                                                                {!! Form::select($ticket->id,[0=>'Open',1=>'Closed'],$ticket->is_closed,['class'=>'form-control border-primary p-0 change-status-btn']) !!}
                                                            @else
                                                                CLOSED
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-sm">
                                                                <a class="btn btn-sm btn-outline-primary" href="{{ route('support-ticket.edit',[$ticket->id]) }}"><i class="fas fa-edit"></i> Edit</a>
                                                                <a class="btn btn-sm btn-outline-primary"  href="{{ route('support-ticket.view',[$ticket->id]) }}"><i class="fas fa-eye"></i> View</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>No open tickets found.</p>
                                        @endif
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

@push('page-js')
    <script>
        function updateTicketStatus(id,status){
            var container = $("#tr-" + id);
            $.ajax({
                url:'/support-ticket/update-ticket-status',
                method:'POST',
                data:{'id':id,'status':status},
                beforeSend:function(){ beforeAjaxBlockUi(container)},
                complete:function(){
                    onAjaxComplete(container);
                },
                success:function(res){
                    onAjaxSuccess(res);
                    container.remove();
                },
                error:onAjaxErrorSweetAlert
            })
        }

        (function(){
            $(document).ready(function(){
                $('.change-status-btn').on('change',function(){
                    var id = $(this).data('id')
                    updateTicketStatus(this.name,this.value);
                });
            })
        })(jQuery)
    </script>
@endpush
