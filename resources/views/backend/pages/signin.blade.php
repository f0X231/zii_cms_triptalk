@extends('layouts.backendBlank')

@section('content')

<h2 class="auth-heading text-center mb-5">{{ __('register.sign.in.title') }}</h2>
<div class="auth-form-container text-start">
    <form 
        class="auth-form login-form" 
        name="signinForm" 
        method="POST" 
        action="{{config('global.link_process')}}/login"
        onsubmit="return validateLoginForm()">
        @csrf
        <div class="email mb-3">
            <label class="sr-only" for="signin-email">{{ __('register.sign.in.username') }}</label>
            <input 
                id="signin-email" 
                name="signinUsername" 
                type="text" 
                maxlength="32"
                class="form-control signin-email" 
                placeholder="{{ __('register.sign.in.username') }}" 
                required="required" />
            <small id="err-username" class="text-danger d-none">{{ __('register.sign.in.username_empty') }}</small>
        </div><!--//form-group-->
        <div class="password mb-3">
            <label class="sr-only" for="signin-password">{{ __('register.sign.in.password') }}</label>
            <input 
                id="signin-password" 
                name="signinPassword" 
                type="password" 
                maxlength="32"
                class="form-control signin-password" 
                placeholder="Password" 
                required="required" />
            <small id="err-password" class="text-danger d-none">{{ __('register.sign.in.password_empty') }}</small>
            <div class="extra mt-3 row justify-content-between">
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" name="signinRememberMe" type="checkbox" value="yes" id="RememberPassword">
                        <label class="form-check-label" for="RememberPassword">{{ __('register.sign.in.rememeber_me') }}</label>
                    </div>
                </div><!--//col-6-->
                <div class="col-6">
                    <div class="forgot-password text-end">
                        <a href="/reset-password">{{ __('register.sign.in.forget_pass') }}</a>
                    </div>
                </div><!--//col-6-->
            </div><!--//extra-->
        </div><!--//form-group-->
        <div class="text-center">
            <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">{{ __('register.sign.in.btn_login') }}</button>
        </div>
    </form>
    
    <div class="auth-option text-center pt-5">{{ __('register.sign.in.no_account') }} <a class="text-link" href="/signup" >{{ __('register.sign.in.btn_signup_here') }}</a>.</div>
</div><!--//auth-form-container-->

@stop