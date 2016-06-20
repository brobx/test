@extends('master')

@section('page.title')
@lang('main.contactUs')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.contactUs'), 'levels' => [['title' => trans('main.contactUs'), 'url' => ''] ] ])

<section class="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contact-form">
					{!! Form::open(['method' => 'POST', 'url' => route('contact.send')]) !!}
						@if(!Auth::check())
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								{!! Form::label('name', trans('main.name')) !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'dir' => 'auto']) !!}

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								{!! Form::label('email', trans('main.email')) !!}
								{!! Form::text('email', null, ['class' => 'form-control', 'dir' => 'auto']) !!}

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						@endif
						@if(Session::has('success'))
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> {{ trans('main.success') }}!</h4>
								{{ Session::get('success') }}
							</div>
						@else
							<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
								{!! Form::label('message', trans('main.messagePlaceholder')) !!}
								{!! Form::textarea('message', null, ['class' => 'form-control', 'dir' => 'auto']) !!}

								@if ($errors->has('message'))
									<span class="help-block">
											<strong>{{ $errors->first('message') }}</strong>
									</span>
								@endif
							</div>
						@endif
						<div class="form-group">
							{!! Form::submit(trans('main.send'), ['class' => 'btn btn-trans btn-block']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="contact-info-wrapper">
					<div class="contact-info">
						<div class="row">
							<div class="col-md-1">
								<i class="fa fa-map-marker fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-md-11">
								<div class="contact-info-text">
									<h2 class="contact-info-title">{{trans('main.location')}}</h2>
									<p>{{trans('main.locationText')}}</p>	
								</div>
							</div>
						</div>
					</div>
					<div class="contact-info">
						<div class="row">
							<div class="col-md-1">
								<i class="fa fa-mobile fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-md-11">
								<div class="contact-info-text">
									<h2 class="contact-info-title">{{trans('main.call')}}</h2>
									<p>+20001010230</p>
								</div>
							</div>
						</div>
					</div>
					<div class="contact-info">
						<div class="row">
							<div class="col-md-1">
								<i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-md-11">
								<div class="contact-info-text">
									<h2 class="contact-info-title">{{trans('main.message')}}</h2>
									<p>example@gmail.com</p>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection