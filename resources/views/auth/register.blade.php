@extends('layouts.plain')

@section('page.title')
@lang('main.register')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-center">
            <div class="login-register">
                <a href="/" class="logo"><img src="/assets/img/logo.png" alt=""></a>
                <h3>{{trans('main.register')}}</h3>
                <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{trans('main.name')}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{trans('main.confirmPassword')}}">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <button type="submit" class="btn btn-trans btn-block">
                        <i class="fa fa-btn fa-user-plus"></i> {{trans('main.register')}}
                    </button>
                </form>
            </div>
            <div class="text-center">
                <a class="btn btn-link link-white" href="{{ url('/login') }}">{{trans('main.haveAccount')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
