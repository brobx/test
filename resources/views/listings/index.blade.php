@extends('master')
@section('page.title', $service->translate()->name)

@section('content')

@include('components.breadcrumb', [
	'levels' => [
		[
			'title' => ucwords($service->corporateType->translate()->title),
			'url' =>  route('industries.show', $service->corporateType->slug)
		],
		[
			'title' => ucwords($service->translate()->name),
			'url' =>  '#'
		],
	]
])

<section class="{{ $service->corporateType->slug == 'travel' ? 'travel' : 'listing' }} listings gray">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				@if(isset($ad))
					<a href="{{ route('out', $ad->id) }}" target="_blank">
					<div class="text-center">
						<img src="/uploads/{{$ad->translate()->image}}" id="ads-image">
					</div>
					</a>
				@endif

				@if(isset($featuredListing) && $featuredListing)
					@include("listings._{$service->corporateType->slug}", ['featured' => true, 'listing' => $featuredListing])
				@endif

				@if($listings->count())
					@foreach($listings as $listing)
						@if($listing->getAttributes()['featured'] != 1)
						@include("listings._{$service->corporateType->slug}", ['service_type' => strtolower($service->name)])
						@endif
					@endforeach
				@else
					<h3 class="text-center">{{ trans('main.noListings') }}</h3>
				@endif

				<div class="pagination-wrapper text-center">
					{!! $listings->render() !!}
				</div>
			</div>
			<!-- Sidebar -->
			<div class="col-md-3">
				<div class="sidebar-wrapper">
					<div class="sidebar">
						<div class="sidebar-heading">
							<h3>{{trans('main.learn')}}</h3>
						</div>
						<div class="sidebar-content">
							<ul>
								@foreach($service->topics as $key => $topic)
									@if($key < 3)
										<li><a href="{{ route('learn.show', $service->id) }}">{{ $topic->translate()->title }}</a></li>
									@endif
								@endforeach
							</ul>
							@if(count($service->topics) > 3)
								<hr>
								<a href="{{ route('learn.show', $service->id) }}">@lang('main.showAll')</a>
							@endif
						</div>
					</div>
					<div class="sidebar">
						<div class="sidebar-heading">
							<h3>{{trans('main.sort')}}</h3>
						</div>
						<div class="sidebar-content">
							@include('partials.sorting')
						</div>
					</div>
					<div class="sidebar">
						<div class="sidebar-heading">
							<h3>{{trans('main.advancedSearch')}}</h3>
						</div>
						<div class="sidebar-content">
							@include('partials.advancedSearch')
						</div>
					</div>
				</div>
			</div>
			<!-- End Sidebar -->
		</div>
	</div>
</section>

	@if(Request::is('*listings'))
		<comparison-slider compare-link="{{ route('services.comparison', $service->id) }}" @if(isset($comparisons)) :listings="{{ json_encode($comparisons) }}" @endif></comparison-slider>
	@endif
@stop