@extends('master')
@section('page.title', 'Travel Booking - Qarenhom')

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.travel'), 'levels' => [['title' => trans('main.travel'), 'url' => ''] ] ])

<section class="travel-booking">
	<div class="container">
		<div class="row">
			@if(! Auth::check())
				<div class="login-fill text-center">
					<a href="{{ action('Auth\AuthController@login') }}" class="btn btn-trans">{{trans('main.loginFill')}}</a>
				</div>
			@endif
			<div class="col-md-10 col-md-offset-1">
				<form action="/thanks">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">{{trans('main.fullName')}}</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">{{trans('main.email')}}</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password">{{trans('main.password')}}</label>
							<input type="password" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password">{{trans('main.confirmPassword')}}</label>
							<input type="password" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<button class="btn btn-trans btn-block travel-submit">{{trans('main.submit')}}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@endsection