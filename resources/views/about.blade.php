@extends('master')

@section('page.title')
@lang('main.about')
@stop

@section('content')

<section class="intro about">
	<section class="section-wrapper">
		<div class="container table">
			<div class="intro-content">
				<h2>{{trans('main.qarenhomWhat')}}</h2>
			</div>
		</div>
	</section>
</section>

<section class="about-us">
	<div class="container">
		<div class="about-desc">
			<h3 class="about-desc-quote">{{trans('main.aboutQuote')}}</h3>
		</div>
	</div>
</section>

<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="feature">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<img src="/assets/img/about-icon.png" class="img-responsive">
						</div>
						<div class="col-md-8 col-xs-8">
							<div class="feature-desc">
								<h2>{{trans('main.featureTitle')}}</h2>
								<p>{{trans('main.featureBody')}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="feature">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<img src="/assets/img/about-icon.png" class="img-responsive">
						</div>
						<div class="col-md-8 col-xs-8">
							<div class="feature-desc">
								<h2>{{trans('main.featureTitle')}}</h2>
								<p>{{trans('main.featureBody')}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="feature">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<img src="/assets/img/about-icon.png" class="img-responsive">
						</div>
						<div class="col-md-8 col-xs-8">
							<div class="feature-desc">
								<h2>{{trans('main.featureTitle')}}</h2>
								<p>{{trans('main.featureBody')}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="feature">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<img src="/assets/img/about-icon.png" class="img-responsive">
						</div>
						<div class="col-md-8 col-xs-8">
							<div class="feature-desc">
								<h2>{{trans('main.featureTitle')}}</h2>
								<p>{{trans('main.featureBody')}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection