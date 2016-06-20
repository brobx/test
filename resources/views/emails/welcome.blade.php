<section class="email-header" style="padding-top: 50px !important; padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <div class="email-header-wrapper" style="padding-bottom: 35px; border-bottom: 1px solid #ddd;">
            <img src="{{URL::to('/')}}/assets/img/logo.png" alt="Qarenhom">
        </div>
    </div>
</section>

<section class="email" style="padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <p>
            Thank you for registering at Qarenhom, you can now get started using the service, below is your information.
		    <br>If you registered using facebook, the password can be changed at any time.
        </p>
        <ul class="email-info" style="padding: 0;">
            <li style="list-style: none;">{{ trans('main.email') }}: {{ $user->email }}</li>
            @if(isset($password) && $password)
            <li style="list-style: none;">{{ trans('main.password') }}: {{ $password }}</li>
            @endif
        </ul>
        <p>{{ trans('main.bestRegards') }},</p>
        <h4><b>{{ trans('main.qarenhomTeam') }}</b></h4>

        <p style="color: #777;">{{ trans('main.emailNotice') }}</p>
    </div>
</section>
