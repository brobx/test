@extends('master')

@section('page.title')
@lang('main.apply')
@stop

@section('content')

@include('components.breadcrumb', [
    'levels' => [
        ['title' => $listing->corporate->type->translate()->title, 'url' => route('industries.show', $listing->corporate->type->slug)],
        ['title' => $listing->service->translate()->name, 'url' => route('services.listings', $listing->service->id)],
        ['title' => $listing->translate()->name, 'url' => route('listing.show', $listing->id)],
        ['title' => trans('main.apply'), 'url' => route('listing.apply', $listing->id)]
    ]
])

<section class="apply gray">
	<div class="container small-width">
		<div class="process">
			<div class="row">
				<div class="process-text">
					<p>@lang('main.checkOut')</p>
				</div>
				<div class="col-md-4 border-top completed no-padding">
					<div class="process-item">
						<p class="process-num inline">1</p>
						<p class="inline">{{ trans('main.compare') }}</p>
					</div>
				</div>
				<div class="col-md-4 border-top completed no-padding">
					<div class="process-item">
						<p class="process-num inline">2</p>
						<p class="inline">{{ trans('main.apply') }}</p>
					</div>
				</div>
				<div class="col-md-4 border-top completed no-padding">
					<div class="process-item">
						<p class="process-num inline">3</p>
						<p class="inline">{{ trans('main.confirm') }}</p>
					</div>
				</div>

				<div class="col-md-12">
					<div class="apply-bank text-center border-bottom">
						<img src="{{ $listing->corporate->details->logo }}">
						<h2>{{ $listing->translate()->name }}</h2>
						<p><b>{{ trans('main.congrats') }}</b> {{ trans('main.applyCompleted') }}</p>
						<a href="{{ route('account.applications.cancel', $lead->id) }}" class="btn btn-trans orange">{{ trans('main.cancelApplication') }}</a>
					</div>
				</div>

			</div>
		</div>

		<div class="services apply border-bottom">
			<h2 class="section-title">{{ trans('main.tryAnotherComparison') }}</h2>
			@foreach($industries as $industry)
				<div class="service">
					<h4 class="services-title">{{ $industry->translate()->title }}</h4>
					<ul class="services-icons">
						@foreach($industry->services as $service)
							<li>
								<a href="{{ route('services.listings', $service->id) }}" class="service-icon-btn">
									<span>
										<img class="service-icon" src="/assets/img/services/{{ $service->icon }}.png" alt="">
									</span>
									<p class="service-name">{{ $service->translate()->name }}</p>
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endforeach
		</div>
	</div>
</section>

@endsection