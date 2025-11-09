@extends('layouts.app')

@section('page-title', trans('app.users'))

@section('content')
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <style>
        .text-center {
            text-align: center !important;
        }
        h5, .h5, div.panel-heading h5.text-center a {
            font-size: 1rem;
            color: #ffffff!important;
            font-weight: bold;
        }
        .team {
            display: inline;
            max-width: 55px;
        }
        .tab-content.list-by-location .col-md-8 p {
            font-size: 12px!important;
            font-weight: bold;
        }
        .panel-info>.panel-heading {
            color: #ffffff!important;
            background-color: #404d67!important;
            border-color: #404d67!important;
        }
        .panel-info {
            border-color: #38445a;
        }
        .panel-body {
            background-color: #f0f2f5!important;
        }
        @media (min-width: 1920px){
            .col-md-3 {
                max-width: 20%!important;
            }
        }
    </style>
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

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabs-1">Sales</a></li>
                        <li><a href="#tabs-2">Team Leaders</a></li>
                        <li><a href="#tabs-3">Parts & Service</a></li>
                        <li><a href="#tabs-4">Service Technicians</a></li>
                        <li><a href="#tabs-5">Detail Department</a></li>
                        <li><a href="#tabs-6">Admin</a></li>
                        <li><a href="#tabs-7">Drivers & Misc</a></li>
                    </ul>

                    <div class="tab-content list-by-location">
                        <div id="tabs-1" class="tab-pane fade in active">
                            @if(isset($users[3]))
                                @foreach($users[3] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @else
                                                        <a href="javascript:void(0)"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @endif
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('user.show',$user->user_id) }}"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(isset($users[16]))
                                @foreach($users[16] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>


                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(isset($users[10]))
                                @foreach($users[10] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="tabs-2" class="tab-pane fade">
                            @if(isset($users[1]))
                                @foreach($users[1] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if(isset($users[15]))
                                @foreach($users[15] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="tabs-3" class="tab-pane fade">
                            @if(isset($users[14]))
                                @foreach($users[14] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>@if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p>@endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(isset($users[17]))
                                @foreach($users[17] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a>
                                                    @if(Auth::user()->hasPermission('user.edit'))
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"><i class="fas fa-history"></i>&nbsp;Logs</a> @endif</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p> @if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p>@endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="tabs-4" class="tab-pane fade">
                            @if(isset($users[12]))
                                @foreach($users[12] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a></h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>
                                                    @if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p>@endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div id="tabs-5" class="tab-pane fade">
                            @if(isset($users[4]))
                                @foreach($users[4] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a></h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p  style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>@if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p>@endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div id="tabs-6" class="tab-pane fade">
                            @if(isset($users[9]))
                                @foreach($users[9] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a></h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p  style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p>@if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p>@endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div id="tabs-7" class="tab-pane fade">
                            @if(isset($users[8]))
                                @foreach($users[8] as $user)
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="text-center">
                                                    <a href="{{ route('user.edit',$user->user_id) }}"><i class="fas fa-user"></i> {{ $user->user->first_name }} {{ $user->user->last_name }}</a></h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-8" style="padding: 0px;">
                                                    <p>
                                                        <i class="fas fa-phone-square"></i>&nbsp;{{ $user->location->fldPhone }}
                                                        @if($user->fld_usr_ext!='')
                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Ext:{{$user->fld_usr_ext}}</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-fax"></i>&nbsp;{{ $user->fld_usr_cell  }}
                                                    </p>
                                                    <p  style="display: inline-flex;">
                                                        <i class="fas fa-envelope"></i>&nbsp;{{ $user->user->email }}
                                                    </p> @if($user->fld_points!='')
                                                        <p style="display: inline-flex;">
                                                            <i class="fas fa-trophy"></i>&nbsp;

                                                            <span style="padding: 2px 2px; font-size: 11px; border-radius: 1px; background-color:#404d67; color:white;">Points:{{$user->fld_points}}</span>

                                                            <a data-fancybox data-type="ajax" data-src="{{ route('list.edit-point',$user->user_id) }}" href="javascript;">
                                                                Edit Points
                                                            </a>
                                                        </p> @endif

                                                </div>
                                                <div class="col-md-4" style="padding: 0px; text-align: right;">
                                                    <img  class="img-responsive team" src="{{ $user->user->gravatar() }}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".nav-tabs a").click(function(){
                $(this).tab('show');
                $(".nav-tabs li").removeClass('active');
                $(this).parent().addClass('active');
            });
        });
    </script>
@stop
