@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Support Ticket #{{ $ticket->id }}</h3>
        </div>
    </div>
    <div class="content-body">
        <div id="view-ticket">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="card-title"><b>Subject :&nbsp;</b>{{ $ticket->subject }}</div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! nl2br($ticket->message) !!}</p>
                                @if($ticket->file)
                                    @php
                                        $files = explode(',',$ticket->file);
                                    @endphp
                                    @if($ticket->IsDownloadableAttribute() == 'true')
                                        @foreach($files as $fileData)
                                            <img onclick="showImage('{{\Storage::url($fileData)}}');" src="{{ \Storage::disk('public')->url($fileData) }}" style="border: 1px solid black; margin-bottom: 5px;" width="80" height="80">
                                        @endforeach
                                    @else
                                        @foreach($files as $fileData)
                                            <p>
                                                <a href="{{ route('support-ticket.download.file',$ticket->id) }}?file={{ $fileData }}"><i class="fa fa-download"></i>&nbsp;{{ $ticket->file_name }}</a>
                                            </p>
                                        @endforeach
                                    @endif
                                @endif
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table class="table">   
                                            <tr>
                                                <th class="no-border-top">Date Submitted</th>
                                                <td><span data-toggle="tooltip" data-title="{{ $ticket->created_at->format('j M, Y @ h:i a') }}">{{ $ticket->created_at->format('j M, Y') }}</span></td>
                                            </tr>
                                            <tr>
                                                <th>Submitted By</th>
                                                <td>
                                                    {{ $ticket->user ? $ticket->user->full_name : 'N/A' }} <span><strong style="color: red;cursor: pointer;">EXT - {{ $ticket->user ? $ticket->user->phone : 'N/A'}}</strong></span><br/>
                                                    ( {{ $ticket->user ? $ticket->user->email : 'N/A' }} )
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Support Category</th>
                                                <td>{{ $ticket->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Priority</th>
                                                <td>{{ $ticket->priority }}</td>
                                            </tr>
                                            <tr>
                                                <th>Assigned To</th>
                                                <td>
                                                    @foreach($ticket->users()->get() as $user)
                                                        {{ $user->first_name }} ({{ $user->email }})<br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="bg-{{ ( $ticket->is_closed) ? "success" : "info" }} btn btn-sm text-white ">{{ ( $ticket->is_closed) ? "CLOSED" : "OPEN" }}</span>
                                                    @if($ticket->is_closed && $ticket->user_id == Auth::user()->id && Auth::user()->hasRole('superadmin'))
                                                        <a href="{{ route('support-ticket.re-open',['id'=>$ticket->id,'status'=>0]) }}" class="bg-info btn btn-info btn-sm">Re-open</a>
                                                    @endif
                                                    @if(!$ticket->is_closed && ($ticket->user_id == Auth::user()->id || Auth::user()->hasRole('superadmin')))
                                                        <a href="{{ route('support-ticket.close',['id'=>$ticket->id,'status'=>1]) }}" class="bg-danger btn btn-info btn-sm">Close</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('support-ticket.comments')
                </div>
            </div>
        </div>
    </div>
@endsection
