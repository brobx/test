@extends('payment.response')
@section('page.title', 'Payment - Qarenhom')

@section('content')
    <div class="text-center">
        <i class="fa fa-times fa-4x text-danger"></i>
        {{ trans('main.paymentFailure') }}
        {{ $error }}
    </div>
@stop
