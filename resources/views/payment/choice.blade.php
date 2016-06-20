@extends('master')
@section('page.title', 'Payment - Qarenhom')

@section('content')
    <section class="apply gray">
        <div class="row">
            <div class="col-md-12">
                <div class="how-apply">
                    <h3 class="text-center">
                        @lang('main.youCharged') {{ number_format($listing->getFieldValue('Price (Package)')) }} EGP
                    </h3>
                    <div class="col-md-6 no-padding-left apply-option-col no-padding-right">
                        {!! Form::open(['url' => route('listing.pay', $listing->id), 'id' => 'branch-form']) !!}
                        {!! Form::hidden('type', 'branch') !!}
                        <a id="requestBranch" href="#" class="apply-option-click" @if(! Auth::check()) data-remodal-target="modal" @endif>
                            <div class="apply-option text-center">
                                <i class="fa fa-money fa-5x"></i>
                                <div class="apply-option-footer">
                                    @lang('main.payAtAgency')
                                </div>
                            </div>
                        </a>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 no-padding-right apply-option-col no-padding-right">
                        <a href="{{ route('listing.buy', $listing->id) }}" class="apply-option-click" @if(! Auth::check()) data-remodal-target="modal" @endif>
                            <div class="apply-option text-center">
                                <i class="fa fa-credit-card-alt fa-5x"></i>
                                <div class="apply-option-footer">
                                    @lang('main.payNow')
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if(! Auth::check())
            @include('partials.loginModal')
        @endif
    </section>
@stop

@section('scripts')
    <script>
        $('#payNow').click(function (e) {
            e.preventDefault();
            $('#pay-form').submit();
        });

        $('#requestBranch').click(function (e) {
            e.preventDefault();
            $('#branch-form').submit();
        });
    </script>
@stop
