@extends('payment.response')
@section('page.title', 'Payment - Qarenhom')

@section('content')
    <div class="text-center">
        <i class="fa fa-check fa-4x text-success"></i>
        {{ trans('main.paymentSuccess') }}
    </div>
@stop
