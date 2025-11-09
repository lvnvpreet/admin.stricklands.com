@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Create a support ticket</h3>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add a Support Ticket</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::model($ticket,['route'=>'support-ticket.save','id'=>'SupportForm','files'=>true]) !!}
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('subject','Subject') !!}
                                                    {!! Form::text('subject',NULL,['class'=>'form-control border-primary','placeholder'=>"Subject"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('category_id','Subject Category') !!}
                                                    {!! Form::select('category_id',$categories,NULL,['class'=>'form-control border-primary']) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('priority','Subject Priority') !!}
                                                    {!! Form::select('priority',[0=>'Select Category','HIGH'=>'High Priority','MEDIUM'=>'Medium','LOW'=>'Low'],NULL,['class'=>'form-control border-primary']) !!}
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('message','Message') !!}
                                                    {!! Form::textarea('message',null,['class'=>'form-control border-primary','placeholder'=>'Type your message']) !!}
                                                </div>
                                            </div>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager'))
                                                <div class="form-group">
                                                    {!! Form::label('assigned_to','Assign To') !!}
                                                    {!! Form::select('assign_to[]',$admins,NULL,['class'=>'form-control select2 border-primary','id'=>'assign_to','multiple' => 'multiple']) !!}
                                                </div>
                                            @endif
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('file','Attachment') !!}
                                                    {!! Form::file('file[]',['multiple']) !!}
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        @if($ticket->exists)
                                            {!! Form::hidden('id',$ticket->id) !!}
                                        @endif
                                        {!! Form::close() !!}
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
