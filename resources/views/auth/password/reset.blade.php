@extends('layouts.auth')

@section('page-title', trans('app.reset_password'))

@section('content')

    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1">
                            <img src="{{ url('assets/images/logo.png') }}" alt="{{ settings('app_name') }}">
                        </div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>Reset Your Password</span>
                    </h6>
                    @include('partials/messages')
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form role="form" action="{{ url('password/reset') }}" method="POST" id="reset-password-form" autocomplete="off">

                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" name="email" id="email" class="form-control form-control-lg input-lg" placeholder="@lang('app.your_email')"0
                                       required>
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="password" id="password" class="form-control form-control-lg input-lg"
                                       placeholder="@lang('app.new_password')" required>
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>

                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg input-lg"
                                       placeholder="@lang('app.confirm_new_password')" required>
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>

                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Update Password</button>
                        </form>
                    </div>
                </div>

                    <div class="card-footer">
                        <div class="">
                            <p class="float-sm-right text-center m-0"><a href="{{ url('login') }}" class="card-link">Login</a></p>
                        </div>
                    </div>

            </div>
        </div>
    </div>



@stop
