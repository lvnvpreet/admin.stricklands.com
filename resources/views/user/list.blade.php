@extends('layouts.app')

@section('page-title', trans('app.users'))

@section('content')

<div class="row">
    <div class="col-12">
        @include('partials.messages')
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                        <h2 class="panel-title">Employee Listing</h2>
                    </div>
                    <div class="col col-xs-6 text-right">

                    </div>
                </div>
            </div>



<div class="panel-body" id="users-table-wrapper">
    <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <th>Name</th>
            <th>@lang('app.email')</th>
            <th>User Level</th>
            <th>Location</th>
            <th>Cell</th>
            <th>Ext</th>
            @if(Auth::user()->hasPermission(['user.delete','user.edit'],false))
            <th class="text-center">@lang('app.action')</th>
            @endif
        </thead>
        <tbody>
            @if (count($users))
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{$user->gravatar()}}" style="width: 40px; margin-right: 5px;">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ @ucfirst($user->role->name) }}</td>
                        <td>{{ @$user->details->location->fldLocationName }}</td>
                        <td>{{ @$user->details->fld_usr_cell }}</td>
                        <td>{{ @$user->details->fld_usr_ext }}</td>

                        @if(Auth::user()->hasPermission(['user.delete','user.edit'],false))
                        <td class="text-center">
                            @permission('user.edit')
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_user')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            @endpermission

                            @permission('user.delete')
                            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_user')"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-method="DELETE"
                                    data-confirm-title="@lang('app.please_confirm')"
                                    data-confirm-text="@lang('app.are_you_sure_delete_user')"
                                    data-confirm-delete="@lang('app.yes_delete_him')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                            @endpermission
                        </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
        </tbody>
    </table>


</div>
            {{--<div class="panel-footer">
                <div class="row">
                    <div class="col col-xs-4">Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                    </div>
                    <div class="col col-xs-8">
                        {{ $users->appends(Input::except('page'))->links() }}
                        <ul class="pagination visible-xs pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>--}}
        </div>
    </div></div>
@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
