@extends('master')

@section('page.title')
@lang('main.account')
@stop

@section('content')

    @include('components/breadcrumb', [ 'title' => trans('main.myAccount'), 'levels' => [['title' => trans('main.myAccount'), 'url' => ''] ] ])

    <section class="account">
        <div class="container">
            @include('components.alerts')
            <div class="row account-boxes-wrapper">
                <div class="col-md-4">
                    {!! Form::model($user, ['method' => 'PATCH', 'url' => route('account.profile.update')]) !!}
                    <div class="account-box">
                        <h3>@lang('main.profile')</h3>
                        <div class="inner">
                            <div class="form-group">
                                {!! Form::label('name', trans('main.name')) !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', trans('main.email')) !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('phone', trans('main.mobilePhone')) !!}
                                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('gender', trans('main.gender')) !!}
                                {!! Form::select('gender', [0 => 'Male', 1 => 'Female'], null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('address', trans('main.address')) !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('city', trans('main.city')) !!}
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group datepicker">
                                {!! Form::label('birth_date', trans('main.dateOfBirth')) !!}
                                {!! Form::text('birth_date', null, ['class' => 'form-control', 'v-date-picker']) !!}
                            </div>

                            <div class="form-group">
                                <a href="{{ route('account.changePassword') }}">@lang('main.changePw')</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::submit(trans('main.update'), ['class' => 'btn-trans btn-trans-alt']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4">
                    {!! Form::open(['method' => 'PATCH', 'url' => route('account.interests.update')]) !!}
                    <div class="account-box">
                        <h3>@lang('main.interests')</h3>
                        <div class="inner">
                            @foreach($corporateTypes as $index => $corporateType)
                                {!! $index ? '<hr>' : '' !!}
                                <h5>{{ $corporateType->translate()->title }}</h5>
                                @foreach($corporateType->services as $service)
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('services[]', $service->id, $user->interests->where('id', $service->id)->first()) !!} {{ $service->translate()->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    {!! Form::submit(trans('main.update'), ['class' => 'btn-trans btn-trans-alt']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4">
                    {!! Form::open(['method' => 'PATCH', 'url' => route('account.preferences.update')]) !!}
                    <div class="account-box">
                        <h3>@lang('main.notifications')</h3>
                        <div class="inner">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('opt_in_application_updates', true, $settings->has('opt_in_application_updates')) !!} @lang('main.applicationUpdates')
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('opt_in_news_and_updates', true, $settings->has('opt_in_news_and_updates')) !!} @lang('main.newsAndUpdates')
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('opt_in_special_offers', true, $settings->has('opt_in_special_offers')) !!} @lang('main.specialOffers')
                                </label>
                            </div>

                            <hr>

                            <h5>@lang('main.notificationPref')</h5>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('notification_channel_sms', true, $settings->has('notification_channel_sms')) !!} @lang('main.sms')
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('notification_channel_email', true, $settings->has('notification_channel_email', 'email')) !!} @lang('main.contactEmail')
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('notification_channel_social', true, $settings->has('notification_channel_social')) !!} @lang('main.socialMedia')
                                </label>
                            </div>

                            <hr>

                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('opt_in_third_party_offers', true, $settings->has('opt_in_third_party_offers')) !!} @lang('main.thirdPartyNotifications')
                                </label>
                            </div>
                        </div>
                    </div>
                    {!! Form::submit(trans('main.update'), ['class' => 'btn-trans btn-trans-alt']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    @if($user->leads->count())
        <section class="account activity">
        <div class="container">
            <h3>@lang('main.activity')</h3>
            <table class="table">
                <tr>
                    <th>@lang('main.serviceProvider')</th>
                    <th>@lang('main.productName')</th>
                    <th>@lang('main.applicationMethod')</th>
                    <th>@lang('main.review')</th>
                    <th></th>
                </tr>
                @foreach($user->leads as $lead)
                    <tr @if($lead->canceled) class="bg-danger" @endif>
                        <td>
                            <a href="{{ route('corporates.show', $lead->listing->corporate_id) }}">
                                {{ $lead->listing->corporate->translate()->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('listing.show', $lead->listing_id) }}">
                                {{ $lead->listing->translate()->name }}
                            </a>
                        </td>
                        <td>{!! $lead->present()->textType !!}</td>

                        @if(! $lead->canceled)
                            @if($lead->review)
                                <td>
                                    <div class="listing-rating">
                                        @for($i = 0; $i < $lead->review->rating; $i++)
                                            <i class="fa fa-star fa-2x"></i>
                                        @endfor
                                        @for($i = 0; $i < 5 - $lead->review->rating; $i++)
                                            <i class="fa fa-star-o fa-2x"></i>
                                        @endfor
                                    </div>
                                </td>
                            @elseif(! $lead->canRate)
                                <td>@lang('main.cannotRate')
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="{{ trans('main.rateAbility') }}">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </td>
                            @else
                                <td><a href="{{ route('listing.getRate', $lead->listing->id) }}">@lang('main.rateNow')</a></td>
                            @endif
                            <td><a href="{{ route('account.applications.cancel', $lead->id) }}">@lang('main.cancelApplication')</a></td>
                        @else
                            <td>
                                <div class="text-center">---</div>
                            </td>
                            <td>@lang('main.applicationCanceled')</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
    @endif

@endsection