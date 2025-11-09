<div class="panel panel-default">
    <div class="panel-heading">Employee Details</div>

<?php //echo"<pre>"; print_r(Auth::user());die;?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">@lang('app.first_name')</label>
                    <input type="text" class="form-control" id="first_name"
                           name="first_name" placeholder="@lang('app.first_name')" value="{{ $edit ? $user->details->fld_usr_fname : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="last_name">@lang('app.last_name') </label>
                        <input type="text" class="form-control" id="last_name"
                               name="last_name" placeholder="@lang('app.last_name')" value="{{ $edit ? $user->details->fld_usr_lastname : '' }}">
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ext">Extension</label>
                    <div class='input-group date'>
                        <input type='text' placeholder="Extension" name="ext" id='ext' value="{{ $edit ? $user->details->fld_usr_ext : '' }}" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Cell Phone</label>
                    <input type="text" class="form-control" id="phone"
                           name="phone" placeholder="Cell Phone" value="{{ $edit ? $user->details->fld_usr_cell : '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="old-admin-email">Old Site Email</label>
                    <input type="text" class="form-control" id="old-admin-email"
                           name="fld_usr_email" placeholder="Old Site Email" value="{{ $edit ? $user->details->fld_usr_email : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="old-admin-password">Old Admin Password</label>
                    <input type="text" class="form-control" id="old-admin-password"
                           name="fld_usr_password" placeholder="Old Admin Password" value="{{ $edit ? $user->details->fld_usr_password : '' }}">
                </div>
            </div>
        </div>
        <!--  Manager Role Edit only if Level ID <= 3  -->
        </br>
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 8)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="old-admin-password">Points</label>
                        <input type="text" class="form-control" id="points"
                               name="points" placeholder="points" value="{{ $edit ? $user->details->fld_points : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="visible">Visible</label>
                        {!! Form::select('visible', ['on'=>'on','off'=>'off'], $edit ? $user->details->fld_usr_cell_on : '',
                           ['class' => 'form-control', 'id' => 'visible']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="targets">New Targets</label>
                        <input type="text" class="form-control" id="targets"
                               name="targets" placeholder="targets" value="{{ $edit ? $user->details->fld_new_target : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="used">Used Target</label>
                        <input type="text" class="form-control" id="used"
                               name="used" placeholder="used" value="{{ $edit ? $user->details->fld_usr_target : '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jobtitle">Job Title</label>
                        {!! Form::select('jobtitle', $positions, $edit ? $user->details->fld_usr_cat : '',
                            ['class' => 'form-control', 'id' => 'status', $profile ? 'disabled' : '','required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Location</label>
                        {!! Form::select('user_location', $locations, $edit ? $user->details->fld_usr_location : '', ['class' => 'form-control','required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">New Admin User Level</label>
                        {!! Form::select('role_id', $roles, $edit ? $user->role->id : 5,
                            ['class' => 'form-control', 'id' => 'role_id', $profile ? 'disabled' : '']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fld_usr_level">Old Admin User Level</label>
                        {!! Form::select('fld_usr_level', $oldlevels, $edit ? $user->details->fld_usr_level : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fld_logistics_level">Logistics Level</label>
                        {!! Form::select('fld_logistics_level', $oldlevels, $edit ? $user->details->fld_logistics_level : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Trade Level</label>
                        {!! Form::select('fld_tradein_level', $oldlevels, $edit ? $user->details->fld_tradein_level : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Auction Level</label>
                        {!! Form::select('fld_auction_level', $oldlevels, $edit ? $user->details->fld_auction_level : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">HR Level</label>
                        {!! Form::select('fld_hr_level', $oldlevels, $edit ? $user->details->fld_hr_level : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Team</label>
                        {!! Form::select('fld_team_role', $teamRoles, $edit ? $user->details->fld_team_role : 9, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fld_is_team">Team Leader</label><br>
                        {!! Form::checkbox('fld_is_team', 1, ($user->details->fld_is_team == 0) ? false : true , ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        @endif
    <!--  Manager Role Edit only if Level ID <= 3  -->
        <div class="row">
            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        @lang('app.update_details')
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
