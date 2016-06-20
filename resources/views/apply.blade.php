@extends('master')

@section('page.title')
@lang('main.apply')
@stop


@section('content')

@include('components/breadcrumb', [
	'levels' => [
		['title' => $listing->corporate->type->translate()->title, 'url' => route('industries.show', $listing->corporate->type->slug)],
		['title' => $listing->service->translate()->name, 'url' => route('services.listings', $listing->service->id)],
		['title' => $listing->translate()->name, 'url' => route('listing.show', $listing->id)],
		['title' => trans('main.apply'), 'url' => route('listing.apply', $listing->id)]
	]
])


<section class="apply gray">
	<div class="container">
		@include('components.alerts')
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
				<div class="col-md-4 border-top no-padding">
					<div class="process-item">
						<p class="process-num inline">2</p>
						<p class="inline">{{ trans('main.apply') }}</p>
					</div>
				</div>
				<div class="col-md-4 border-top no-padding">
					<div class="process-item">
						<p class="process-num inline">3</p>
						<p class="inline">{{ trans('main.confirm') }}</p>
					</div>
				</div>

				<div class="col-md-12 no-padding apply-option-col">
					<div class="apply-bank text-center border-bottom">
						<img src="{{ imagePath($listing->corporate->details->logo) }}">
						<h2>{{ $listing->translate()->name }}</h2>
						<a href="{{ route('services.listings', $listing->service_id) }}" class="btn btn-trans">{{ trans('main.change') }}</a>
						<a href="{{ route('home') }}" class="btn btn-trans orange">{{ trans('main.cancel') }}</a>
					</div>
				</div>

				<div class="col-md-12">
					<div class="how-apply">
						<h2 class="text-center">{{ trans('main.howDoYouWantApply') }}</h2>
						<div class="row">
							<div class="col-md-4 no-padding-left apply-option-col">
								{!! Form::open(['url' => route('listing.apply', $listing->id), 'id' => 'phone-application']) !!}
								{!! Form::hidden('type', 'callback') !!}
								<a id="requestCall"  class="apply-option-click"
								   @if(! Auth::check()) href="#" data-remodal-target="modal" @endif
								   @if(Auth::check() && ! Auth::user()->phone) href="#" data-remodal-target="phone-modal" @endif
								>
									<div class="apply-option text-center">
										<i class="fa fa-fax fa-5x"></i>
										<div class="apply-option-footer">
											{{ trans('main.requestCall') }}
										</div>
									</div>
								</a>
								{!! Form::close() !!}
							</div>
							@if($listing->url)
								<div class="col-md-4 no-padding-left apply-option-col">
									{!! Form::open(['url' => route('listing.apply', $listing->id), 'id' => 'online-form']) !!}
									{!! Form::hidden('type', 'online') !!}
									<a id="requestOnline" href="#" class="apply-option-click" @if(! Auth::check()) data-remodal-target="modal" @endif>
										<div class="apply-option text-center">
											<i class="fa fa-pencil-square-o fa-5x"></i>
											<div class="apply-option-footer">
												{{ trans('main.applyOnline') }}
											</div>
										</div>
									</a>
									{!! Form::close() !!}
								</div>
							@endif
							<div class="col-md-4 no-padding-left apply-option-col no-padding-right">
								{!! Form::open(['url' => route('listing.apply', $listing->id), 'id' => 'branch-form']) !!}
									{!! Form::hidden('type', 'branch') !!}
									<a id="requestBranch" href="#" class="apply-option-click" @if(! Auth::check()) data-remodal-target="modal" @endif>
										<div class="apply-option text-center">
											<i class="fa fa-map-marker fa-5x"></i>
											<div class="apply-option-footer">
												{{ trans('main.findBranch') }}
											</div>
										</div>
									</a>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@if(! Auth::check())
			@include('partials.loginModal')
		@endif
		@if(Auth::check() && ! Auth::user()->phone)
			@include('partials.addPhoneNumberModal')
		@endif
	</div>
</section>

@endsection

@section('scripts')
	@if(Auth::check())
		<script>
			$('#requestOnline').click(function (e) {
				e.preventDefault();
				$('#online-form').submit();
			});

			$('#requestBranch').click(function (e) {
				e.preventDefault();
				$('#branch-form').submit();
			});
		</script>
	@endif
	@if(Auth::check() && Auth::user()->phone)
		<script>
			$('#requestCall').click(function (e) {
				e.preventDefault();
				$('#phone-application').submit();
			});
		</script>
	@endif
@stop