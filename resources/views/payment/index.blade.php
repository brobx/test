@extends('master')
@section('page.title', 'Payment - Qarenhom')

@section('content')
    <section class="apply gray">
        <div class="row">
            <div class="text-center">
                <h4>{{ trans("main.payNow") }}</h4>
                <form id="paymentForm" method="post" action="{{ config('services.payfort.page') }}" target="payfort">
                @foreach($parameters as $key => $value)
                    {!! Form::hidden($key, $value) !!}
                @endforeach
                {!! Form::submit(number_format($listing->getFieldValue('Price (Package)')) . " " . trans("main.egp"), ['class' => 'btn btn-trans', 'id' => 'paymentSubmit']) !!}
                </form>
                <iframe name="payfort" id="payfort" frameborder="0" scrolling="no" height="800" width="100%" style="display: none;"></iframe>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script>
        $('#paymentForm').submit(function () {
            $('#payfort').show();
            $('#paymentSubmit').hide();
        });
    </script>
@stop
