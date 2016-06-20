@extends('layouts.plain')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-center">
            <div class="login-register">
                <a href="/" class="logo"><img src="/assets/img/logo.png" alt=""></a>
                <h3>@lang('main.resetPassword')</h3>
                @if (session('status'))
                    {{ session('status') }}
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <!-- <label class="control-label">E-Mail Address</label> -->
                            
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('main.email') }}">
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <button type="submit" class="btn btn-trans btn-block">
                        <i class="fa fa-btn fa-refresh"></i> @lang('main.resetPassword')
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

@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
