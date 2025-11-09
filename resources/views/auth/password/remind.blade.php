@extends('layouts.auth')

@section('page-title', trans('app.reset_password'))

@section('content')

        <div class="col-12 d-flex align-items-center justify-content-center">

            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title text-center">
                            @include('partials.messages')
                            <img src="{{ url('assets/images/logo.png') }}" alt="{{ settings('app_name') }}">
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>We will send you a link to reset password.</span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form role="form" action="<?= url('password/remind') ?>" method="POST" id="remind-password-form" autocomplete="off">
                                <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="email" class="form-control form-control-lg input-lg" id="email"
                                           placeholder="Your Email Address" required name="email">
                                    <div class="form-control-position">
                                        <i class="ft-mail"></i>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block"><i class="ft-unlock"></i> Recover Password</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer border-0">
                        <p><strong>Note:</strong>Remember to check you spam folder for the password reset message</p>
                        <p class="float-sm-left text-center"><a href="{{ url('login') }}" class="card-link">Login</a></p>
                       {{-- <p class="float-sm-right text-center">New to Stack ? <a href="register-simple.html" class="card-link">Create Account</a></p>--}}
                    </div>
                </div>
            </div>
        </div>



@stop

{{--
@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\PasswordRemindRequest', '#remind-password-form') !!}
@stop--}}
