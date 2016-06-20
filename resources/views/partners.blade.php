@extends('master')

@section('page.title')
@lang('main.partners')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.partners'), 'levels' => [['title' => trans('main.partners'), 'url' => ''] ] ])

<section class="partnersPage">
	<div class="container">
		<div class="row">
			<div class="partners-wrapper">
				@foreach($corporateTypes as $corporateType)
				<div class="partner">
					<h2 class="section-title blue">{{ $corporateType->translate()->title }}</h2>
					<ul>
						@foreach($corporateType->partners as $partner)
						<li class="partner-item">
							<a href="{{ route('corporates.show', $partner->id) }}">
								<img src="/uploads/{{ $partner->details->logo }}" class="partner-img">
								<h4 class="partner-name">{{ $partner->translate()->name }}</h4>
							</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

@endsection