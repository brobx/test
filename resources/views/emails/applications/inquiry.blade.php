<section class="email-header" style="padding-top: 50px !important; padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <div class="email-header-wrapper" style="padding-bottom: 35px; border-bottom: 1px solid #ddd;">
            <img src="{{URL::to('/')}}/assets/img/logo.png" alt="Qarenhom">
        </div>
    </div>
</section>

<section class="email" style="padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <span>You have a new inquiry</span>
        <p>Inquirer name: {{$name}}</p>
        <p>Inquirer email: {{$email}}</p>
        <hr>
        <p>Inquiry:</p><br>
        <p>{{ $inquiry }}</p>
        <hr>
        <p>{{ trans('main.bestRegards') }},</p>
        <h4><b>{{ trans('main.qarenhomTeam') }}</b></h4>
    </div>
</section>