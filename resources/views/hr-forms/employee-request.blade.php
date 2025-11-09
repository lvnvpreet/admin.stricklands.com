@extends('layouts.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6">
            <h3>All Employee Requests</h3>
        </div>
        <div class="content-header-right col-md-6">
            <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
                <a href="{{ route('hr-form.contract-request.create') }}" class="btn btn-outline-primary"> Create New Request</a>
            </div>
        </div>
    </div>
    <div class="content-body pt-1">
        <div class="row">
            <div class="col-12">
                <div class="card p-1">
                    @if($employeeRequests->count())
                        <table id="table" class="table table-bordered table-responsive-lg table-hover zero-configuration dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Location</th>
                                <th>Wage</th>
                                <th>Position</th>
                                <th>Department</th>
                                @if(!request()->routeIs('hr-form.contract'))
                                <th>Status</th>
                                @endif
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employeeRequests as $empReq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td
                                            @if($empReq->notes)
                                            data-toggle="popover"
                                            data-content="<b>Notes</b>: {{ $empReq->notes }}<br/><b>Start Date</b>: {{ ($empReq->start_date)? : "" }}"
                                            data-html="true"
                                            @endif
                                    >{{ $empReq->full_name }} {{ ($empReq->notes || $empReq->start_date) ? "*" : "" }}</td>
                                    <td>{{ $empReq->email }}</td>
                                    <td>{{ $empReq->phone }}</td>
                                    <td>{{ $empReq->address }}</td>
                                    <td>{{ $empReq->location }}</td>
                                    <td>{{ $empReq->wage }}</td>
                                    <td>{{ $empReq->position }}</td>
                                    <td>{{ $empReq->department }}</td>
                                    @if(!request()->routeIs('hr-form.contract'))
                                    <td>
                                        <div class="holder">
                                            {{ Form::select($empReq->id,[0=>'Pending',1=>'Created'],$empReq->contract_made,['class'=>'form-group status-select p-0']) }}
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        <div class="btn-group btn-sm">
                                            <a href="{{ route('hr-form.contract-request.edit',[$empReq->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $empReq->id }}"><i class="fa fa-trash"></i> Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        @if(request()->routeIs('hr-form.contract'))
                            <p>No Employee Contract Found.</p>
                        @else
                            <p>No Employee Contract Request Found.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var selects = document.querySelectorAll('.status-select');
        for (i = 0; i < selects.length; i++) {
            //Add OnChange Event
            selects[i].addEventListener('change',function(){
                //console.log(this.name);
                var input = this;
                var container  = $(this).closest('.holder');
                var url = '{{ trim(route('hr-form.contract-request-form'),'/') }}'
                url += '/' + this.name + '/change-status'
                $.ajax({
                    url: url,
                    method:'POST',
                    beforeSend:function(){ beforeAjaxBlockUi(container) },
                    complete:function(){ onAjaxComplete(container);},
                    success:function(res){
                        onAjaxSuccess(res);
                        $(input).closest('tr').remove();
                    },
                    error:onAjaxErrorSweetAlert
                })
            })
        }


        var btns = document.querySelectorAll('.delete-btn');
        console.log(btns);
        for( j=0; j < btns.length ; j++ ) {
            btns[j].addEventListener('click',function(){ console.log('jello')
                var btn = this;
                var container  = $(this).closest('.row');
                $.ajax({
                    url: '{{ route('hr-form.contract-request.delete') }}',
                    method:'POST',
                    data:{'id':$(btn).data('id')},
                    beforeSend:function(){ beforeAjaxBlockUi(container) },
                    complete:function(){ onAjaxComplete(container);},
                    success:function(res){
                        onAjaxSuccess(res);
                        $(btn).closest('tr').remove();
                    },
                    error:onAjaxErrorSweetAlert
                })
            })
        }
    </script>
@endsection
