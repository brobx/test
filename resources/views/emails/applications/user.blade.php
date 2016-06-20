<section class="email-header" style="padding-top: 50px !important; padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <div class="email-header-wrapper" style="padding-bottom: 35px; border-bottom: 1px solid #ddd;">
            <img src="{{URL::to('/')}}/assets/img/logo.png" alt="Qarenhom">
        </div>
    </div>
</section>

<section class="email" style="padding: 15px 0;">
    <div class="container" style="width: 440px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <h4 class="email-title" style="font-weight: bold; color: #23aae1; margin-bottom: 25px;">{{ trans('main.emailTitle') }}</h4>
        <p>{{ trans('main.emailDear') }}</p>
        <p>{{ trans('main.emailBody', ['type' => $lead->type]) }}</p>
        <p>{{ trans('main.emailCancel') }}</p>

        <h5 style="text-decoration: underline;">{{ trans('main.emailApplicant') }}</h5>
        <ul class="email-info" style="padding: 0;">
            <li style="list-style: none;">{{ trans('main.name') }}: {{ $user->name }}</li>
            <li style="list-style: none;">{{ trans('main.email') }}: {{ $user->email }}</li>
            <li style="list-style: none;">{{ trans('main.mobile') }}: {{ $user->phone }}</li>
            <li style="list-style: none;">{{ trans('main.emailPrefrred') }}: </li>
        </ul>
        <h5 style="text-decoration: underline;">{{ trans('main.product') }}</h5>
        <ul class="email-info" style="padding: 0;">
            <li style="list-style: none;">{{ trans('main.serviceProvider') }}: {{ $listing->corporate->translate()->name }}</li>
            <li style="list-style: none;">{{ trans('main.productName') }}: {{ $listing->translate()->name }}</li>
            @foreach($highlights as $highlight)
                <li style="list-style: none;">{{ $highlight->translate()->name }}: {{ $listing->getField($highlight->name)->present()->value }}</li>
            @endforeach
        </ul>
        <p>{{ trans('main.bestRegards') }},</p>
        <h4><b>{{ trans('main.qarenhomTeam') }}</b></h4>

        <p style="color: #777;">{{ trans('main.emailNotice') }}</p>
    </div>
</section>