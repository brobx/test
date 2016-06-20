@extends('master')

@section('page.title')
@lang('main.thankyou')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.travel'), 'levels' => [['title' => trans('main.travel'), 'url' => ''] ] ])

<section class="thanks">
	<div class="container">
		<div class="thanks-msg text-center">
			<h2>{{trans('main.thanksMsg')}}</h2>
			<h4>{{trans('main.thankyou')}}</h4>
		</div>
	</div>
</section>

<section class="help-contact">
    <div class="container text-center">
        <h3>{{trans('main.cantFind')}}</h3>
        <a href="{{ route('contact') }}" class="btn btn-trans">{{ trans('main.contactUs') }}</a>
    </div>
</section>

@endsection