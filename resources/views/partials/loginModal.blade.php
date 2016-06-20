<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="join">
        <div class="row">
            <div class="join-wrapper">
                <div class="col-md-6 border-right">
                    <div class="login-join">
                        <div class="modal-heading">
                            <h3>{{ trans("main.alreadyRegistered") }}</h3>
                            <p class="login-info">{{ trans("main.loginNow") }}</p>
                        </div>
                        <a id="login-fb" href="{{ route('auth.getSocialAuth') }}"><i class="fa fa-facebook"></i> {{ trans('main.loginFB') }}</a>
                        <p class="or"><span>{{ trans('main.or') }}</span></p>
                        {!! Form::open(['url' => action('Auth\AuthController@login')]) !!}
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="{{ trans('main.email') }}">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="{{ trans('main.password') }}">
                            </div>
                            <div class="checkbox inline pull-left">
                                <label>
                                    <input name="remember" type="checkbox"> {{ trans('main.rememberMe') }}
                                </label>
                            </div>
                            <a href="#" class="forget-pass inline pull-right">{{ trans("main.forgotPassword") }}</a>
                            <button type="submit" class="btn btn-trans btn-block green">{{ trans("main.login") }}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-join text-center">
                        <h3>{{ trans('main.needAccount') }}</h3>
                        <p class="login-info"></p>
                        <a id="login-fb" href="{{ route('auth.getSocialAuth') }}"><i class="fa fa-facebook"></i> {{ trans('main.registerFB') }}</a>
                        <p class="or"><span>{{ trans('main.or') }}</span></p>
                        {!! Form::open(['url' => action('Auth\AuthController@register')]) !!}
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="{{ trans('main.name') }}">
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="{{ trans('main.email') }}">
                            </div>
                            <div class="form-group">
                                <input name="phone" type="text" class="form-control" placeholder="{{ trans('main.mobilePhone') }}">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="{{ trans('main.password') }}">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('main.confirmPassword') }}">
                            </div>
                            {!! Form::submit(trans("main.register"), ['class' => 'btn btn-trans btn-block green'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
