@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Support Tickets</h3>
        </div>
        @cannot('has-role','Admin|superadmin')
        <div class="content-header-right col-md-6 col-12">
            <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                <div role="group" class="btn-group">
                    <a href="{{ route('support-ticket.add') }}" class="btn btn-outline-primary "><i class="ft-plus icon-left"></i> Add</a>
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
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        @if($tickets->count())
                                            <table id="table" class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable" style="width: 100% !important">
                                                <thead>
                                                <tr>
                                                    <th style="display: none;">#</th>
                                                    <th class="text-center">#id</th>
                                                    <th>Date</th>
                                                    <th>User Name</th>
                                                    <th>Category</th>
                                                    <th>Priority</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Assigned To</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tickets as $ticket)
                                                    @php
                                                        $last = $ticket->comments()->latest()->first();
                                                    @endphp
                                                    <tr id="tr-{{ $ticket->id }}">
                                                        <th style="display: none;">{{ $loop->iteration }} </th>
                                                        <td class="text-center">{{ $ticket->id }} 
                                                            <i style="cursor: pointer;" class="fa fa-commenting-o" data-toggle="tooltip" data-title="{{ optional($last)->comment ?? "No Comment" }}"></i>
                                                        </td>
                                                        <td data-toggle="tooltip" data-title="{{ $ticket->created_at->format('j F, Y @ h:i a') }}"> <span style="font-size: 0px;"> {{ strtotime($ticket->created_at) }}</span> {{ $ticket->created_at->format('j F, Y') }}</td>
                                                        <td>{{ optional($ticket->user)->full_name }}</td>
{{--                                                        <td>{{ $ticket->user->email }}</td>--}}
                                                        <td>{{ optional($ticket->category)->name }}</td>
                                                        <td>{{ $ticket->priority }}</td>
                                                        <td
                                                            @if(strlen($ticket->subject) > 50)
                                                                data-toggle="tooltip"
                                                                data-title="{{ $ticket->subject }}"
                                                            @endif
                                                        >{{ Illuminate\Support\Str::limit($ticket->subject,50) }}</td>
                                                        <td
                                                            @if(1 || strlen($ticket->message) > 50)
                                                                data-toggle="popover"
                                                                data-content="{{ $ticket->message }}"
                                                            @endif
                                                        >{{ Illuminate\Support\Str::limit($ticket->message,50) }}
                                                        </td>
                                                        <td>
                                                            @if(auth()->user()->hasRole('superadmin'))
                                                                <?php $assigned = $ticket->users()->get(); ?>
                                                                {!! Form::select('assign_to[]',$admins,$assigned,['class'=>'form-control select2 border-primary assign_to_btn','multiple' => 'multiple','id'=>$ticket->id]) !!}
                                                            @else
                                                                @foreach($ticket->users()->get() as $user)
                                                                    {{ $user->first_name }} ({{ $user->email }})<br>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!$ticket->is_closed)
                                                            {!! Form::select($ticket->id,[0=>'Open',1=>'Closed'],$ticket->is_closed,['class'=>'form-control border-primary p-0 change-status-btn']) !!}
                                                            @else
                                                                CLOSED
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-sm">
                                                                <a href="{{ route('support-ticket.view',$ticket->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                                                @if(!$ticket->is_closed)
                                                                    <a href="{{ route('support-ticket.edit',$ticket->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No tickets found.</p>
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

        function updateTicketAssignee(id,val){
            var container = $("#tr-" + id);
            $.ajax({
                url:'/support-ticket/update-ticket-assignee',
                method:'POST',
                data:{'id':id,'assignee':val},
                beforeSend:function(){ beforeAjaxBlockUi(container)},
                complete:function(){
                    onAjaxComplete(container);
                },
                success:function(res){
                    onAjaxSuccess(res);
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

                $('.assign_to_btn').on('change',function(){
                    updateTicketAssignee(this.id,$(this).val());
                });
            })
        })(jQuery)
    </script>
@endpush
