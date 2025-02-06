<?php $settings = \App\Models\Setting::find(1); ?>

@extends('layouts.app')

<style>
    .card {
        background: #212b5b69 !important;
    }

    .login_page label {
        color: #fff;
    }

    .panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .login__page {
        font-family: sans-serif;
    }

    .welcome_url {
        font-size: 32px !important;
    }

    .forgot__url {
        color: #fff !important;
        margin-top: 13px;
        padding-right: 0;
        display: block;
        font-size: 12px;
        font-weight: 300;
        letter-spacing: .5px;
    }

    .login__brand {
        height: 70px;
        background: #fff;
        padding: 6px 10px;
        border-radius: 3px;
        margin-bottom: 20px;
    }

    .login__page {
        padding: 80px 0;
    }

    .btn {
        font-size: 20px !important;
        margin-top: 15px;
    }
    .login__page .form-control{
        border-radius: 2px;
    }
    .login__page .form-group{
        margin-bottom: 25px !important;
    }
    .login__page .card{
        position: relative;
        z-index: 999;
    }
    .login__page .btn.btn-primary{
        margin-top: 0;
        border-radius: 2px;
        width: 177px;
        background: #ff7700 !important;
        border-color: #ff7700 !important;
    }
    .login__page .btn.btn-primary:hover{
        background: #e16900 !important;
        border-color: #e16900 !important;
    }
    @media (max-width: 991px) {
        .welcome_login {
            font-size: 23px;
            margin-top: 14px;
        }

        .welcome_url {
            font-size: 20px !important;
            line-height: 1;
            margin-top: 4px;
            display: block;
        }

        .login__page .panel {
            width: 80%;
            margin: 0 auto;
        }
    }
</style>
@section('content')
    <div class="container login__page">

        <div class="login_page row d-flex justify-content-center align-item-center">

            <div class="col-md-4 col-lg-4 col-md-offset-4 col-10">
                @if($settings->logo)
                    <div class="text-center">
                        <img src="/{{ $settings-> logo }}" alt="{{ $settings->site }}" class="login__brand">
                    </div>
                @endif
                <div class="card" style="box-shadow: 1px 2px 14px -6px;">
                    <div class="panel-heading"><span><a href="/"
                                                        style="color: #000;text-decoration: none;font-family: sans-serif;">< Back</a></span><span
                                style="float: right; color: #000;font-family: sans-serif;">Login</span></div>
                    <div class="card-body">
                        @if(Session::has('danger'))
                            <div class="alert alert-danger show small ">
                                {{ Session::get('danger') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="form-label">E-Mail</label>
                                <div class="">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="form-label">Password</label>
                                <div class="">
                                    <input id="password" type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>
                                    <div class="  mb-3 pb-1  text-end">
                                        @if (Route::has('password.request'))
                                            <a class="forgot__url" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
