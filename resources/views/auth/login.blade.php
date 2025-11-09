@extends('layouts.auth')

@section('page-title', trans('app.login'))

@section('content')

    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <h2>If you do not know your password, please click on "I forgot my password" to have a password reset link emailed to you.</h2>
                    <div class="card-title text-center">
                        <div class="p-1">
                            <img src="{{ url('assets/images/logo.png') }}" alt="{{ settings('app_name') }}">
                        </div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>Login with {{ settings('app_name') }}</span>
                    </h6>
                    @include('partials/messages')
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off">
                            <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                            @if (Input::has('to'))
                                <input type="hidden" value="{{ Input::get('to') }}" name="to">
                            @endif

                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control form-control-lg input-lg" name="username" id="username"  placeholder="@lang('app.email_or_username')"
                                       required>
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control form-control-lg input-lg" name="password" id="password"
                                       placeholder="@lang('app.password')" required>
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                @if (settings('remember_me'))
                                    <div class="col-md-6 col-12 text-center text-md-left">
                                        <fieldset>
                                    <input type="checkbox" name="remember" id="remember" value="1"/>
                                    <label for="remember">@lang('app.remember_me')</label>
                                        </fieldset>
                                    </div>
                                @endif
                                    @if (settings('forgot_password'))
                                        <div class="col-md-6 col-12 text-center text-md-right">
                                        <a href="<?= url('password/remind') ?>" class="forgot">@lang('app.i_forgot_my_password')</a>
                                        </div>
                                    @endif
                                </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                        </form>
                    </div>
                </div>
                @if (settings('reg_enabled'))
                    <div class="card-footer">
                        <div class="">
                            <p class="float-sm-right text-center m-0">New to Stack? <a href="register-simple.html" class="card-link">Sign Up</a></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



@stop

@section('scripts')
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
