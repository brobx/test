@extends('layouts.plain')

@section('page.title')
@lang('main.login')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-center">
            <div class="login-register">
                <a href="/" class="logo"><img src="/assets/img/logo.png" alt=""></a>
                <h3>{{trans('main.login')}}</h3>
                @if($errors->has('suspended'))
                    <div class="has-error text-center">
                        <span class="help-block">
                            <strong>{{ $errors->first('suspended') }}</strong>
                        </span>
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{trans('main.email')}}">
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="{{trans('main.password')}}">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-xs-6 rememberMeOption">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{trans('main.rememberMe')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 forgetPassOption">
                            
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">{{trans('main.forgotPassword')}}</a>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-trans btn-block">
                        <i class="fa fa-btn fa-sign-in"></i> {{trans('main.login')}}
                    </button>
                </form>
            </div>
            <div class="text-center">
                <a class="btn btn-link link-white" href="{{ url('/register') }}">@lang('main.needAccount')</a>
            </div>
        </div>
    </div>
</div>
@endsection
