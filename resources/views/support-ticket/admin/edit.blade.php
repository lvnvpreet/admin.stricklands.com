@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Edit support ticket #{{ $ticket->id }}</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div role="group" class="btn-group float-md-right">
                <div role="group" class="btn-group">
                    <a href="{{ route('support-ticket.open') }}" class="btn btn-outline-primary "><i class="fas fa-chevron-circle-left"></i> Open Tickets</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="basic-elements">
            <div class="row">
                @include('partials.messages')
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($ticket,['route'=>['support-ticket.update',$ticket->id],'id'=>'SupportForm','files'=>true]) !!}
                                <div class="form-body">
                                    <div class="form-group">
                                        {!! Form::label('created_at','Date Submitted') !!}
                                        {{ Form::text('created_at',$ticket->created_at->format('j F,Y @ h:i a'),['class'=>'form-control','readonly']) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('user','User Name') !!}
                                        {{ Form::text('user',$ticket->user->full_name,['class'=>'form-control','readonly']) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email','User Email') !!}
                                        {{ Form::text('email',$ticket->user->email,['class'=>'form-control','readonly']) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('category_id','Subject Category') !!}
                                        {!! Form::select('category_id',$categories,NULL,['class'=>'form-control border-primary']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('priority','Subject Priority') !!}
                                        {!! Form::select('priority',[0=>'Select Category','HIGH'=>'High Priority','MEDIUM'=>'Medium','LOW'=>'Low'],NULL,['class'=>'form-control border-primary']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('subject','Subject') !!}
                                        {!! Form::text('subject',NULL,['class'=>'form-control border-primary','placeholder'=>"Subject","readonly"=>true]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('message','Message') !!}
                                        {!! Form::textarea('message',null,['class'=>'form-control border-primary','placeholder'=>'Type your message',"readonly"=>true,'rows'=>5]) !!}
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group">
                                            {!! Form::label('file','Attachment') !!}
                                            {!! Form::file('file[]',['multiple']) !!}
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            {!! Form::label('file','Attachment') !!}
                                            @if($ticket->file)
                                                @php $files = explode(',',$ticket->file); @endphp
                                                @foreach($files as $key => $file)
                                                    <div id="file-delete-{{$key}}"">
                                                        <a href="{{ route('support-ticket.download.file',[$ticket->id]) }}/?file={{ $file }}"><i class="fa fa-download"></i>&nbsp;{{ $ticket->file_name }} </a> 
                                                    <i class="fa fa-trash" onclick="deleteTicketImage(event,'{{ $key }}');" data-id="{{ $ticket->id }}" data-file="{{ $file }}"> </i>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('Admin'))
                                    <div class="form-group">
                                        {!! Form::label('assigned_to','Assign To') !!}
                                        {!! Form::select('assign_to[]',$admins,$assigned,['class'=>'form-control select2 border-primary','id'=>'assign_to','multiple' => 'multiple']) !!}
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        {!! Form::label('is_closed','Status') !!}
                                        {!! Form::select('is_closed',[0=>'Open',1=>'Closed'],NULL,['class'=>'form-control border-primary']) !!}
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-square-o"></i> Save
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('support-ticket.comments')
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function deleteTicketImage(event,key){
            let imageIndex = key;
            let ticketId = event.target.dataset.id;
            let file = event.target.dataset.file;
            $.ajax({
                url: "{{ url('support-ticket/delete-ticket-image') }}",
                type: "GET",
                data : {
                    ticketId : ticketId,
                    file: file,
                },
                success: function(res){
                    if(res.message == true){
                        $('#file-delete-'+imageIndex).remove();
                    }
                    else{
                        console.log('Error! Please try again.');
                    }
                },
                error : function(error){
                    console.log('Error! Please try again.');
                }
            });
        }
    </script>
@endsection

@section('scripts')
<script type="text/javascript">
$("#assign_to").change(function() {
    if ($("#assign_to option:selected").length > 4) {
        $(this).removeAttr("selected");
        $("#assign_to option:").addAttr("disabled");
        return false;
    }
});

$('select').select2({
  maximumSelectionLength: 4 // only start searching when the user has input 3 or more characters
});
</script>
    {!! JsValidator::formRequest('Vanguard\Http\Requests\SupportTicketRequest', '#SupportForm') !!}
@endsection
