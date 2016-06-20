@extends('master')
@section('page.title', trans('main.'.$type->slug))

@section('content')

<section class="intro product slide {{ $type->slug }}">
	<div class="section-wrapper">
		<div class="container _table">
			<div class="intro-content">
				<div class="row home-product">
					<div class="col-md-7 intro-left">
						<div class="product-slide" id="slides">
							<div class="slide-item">
								<div class="slide-caption">
									<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
										<!-- Wrapper for slides -->
										<div class="carousel-inner" role="listbox">
											@foreach($slides as $index => $slide)
												<div class="item {{ ! $index ? 'active' : '' }}">
													<img src="{{ imagePath($slide->name) }}" class="img-responsive">
													<div class="slide-text">
														<h3>{{ $slide->translate()->title }}</h3>
														<p>{{ $slide->translate()->caption }}</p>
													</div>
												</div>
											@endforeach
										</div>
									</div>
									<div class="arrows">
										<a href="#carousel-example-generic" class="next-arrow right carousel-control" role="button" data-slide="next">
											<img src="/assets/img/arrow-right.png" class="img-responsive">
											<span class="sr-only">Next</span>
										</a>
										<a href="#carousel-example-generic" class="prev-arrow left carousel-control" role="button" data-slide="prev">
											<img src="/assets/img/arrow-left.png" class="img-responsive">
											<span class="sr-only">Previous</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 intro-right">
						<quick-search @if($categories) :categories="{{ $categories }}" @else :services="{{ $services }}" @endif
						              compare-text="{{ trans('main.compare') }}"
									  advanced-text="{{ trans('main.advancedSearch') }}"
						></quick-search>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="partners product">
	<div class="container">
		<div id="partners">
			<div id="owl-example" class="owl-carousel">
				@foreach($corporates as $corporate)
					<div><a href="{{ route('corporates.show', $corporate->id) }}"><img src="{{ imagePath($corporate->details->logo) }}" class="img-responsive"></a></div>
				@endforeach
			</div>
		</div>
	</div>
</section>

<section class="calc gray">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="box budget">
					<div class="col-md-8">
						<h3>{{trans('main.budgetCalc')}}</h3>
						<p>{{trans('main.budgetCalcDesc')}}</p>
					</div>
					<div class="col-md-4">
						<span><i class="fa fa-calculator fa-5x"></i></span>
					</div>
				</div>
				@if(isset($post))
					<div class="box budget">
						<div class="col-md-8">
							<h3>{{trans('main.newsAndUpdates')}}</h3>
							<h4>{{ $post['title'] }}</h4>
							<p>{!! nl2br($post['body']) !!}</p>
						</div>
						<div class="col-md-4">
							<span><i class="fa fa-newspaper-o fa-5x"></i></span>
						</div>
					</div>
				@endif
			</div>
			<div class="col-md-6">
				<div class="video">
					<div class="video-shadow">
						<a href="#" data-remodal-target="modalVideo">
							<img src="/assets/img/home-loan.jpg" class="img-responsive" id="video-thumb">
							<div class="play-icon">
								<img src="/assets/img/icon-play.png" class="play-icon-img">
							</div>
						</a>
						<div id="remodal-video" class="remodal video" data-remodal-id="modalVideo" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
							<button data-remodal-action="close" class="remodal-close"></button>
							<iframe width="100%" height="100%" src="http://www.youtube.com/embed/I5dUlac3Uis" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
<script>
	$("#owl-example").owlCarousel({
		items: 5,
		itemsMobile: false,
		rtl: true,
		loop: true,
		margin: 10,
		callbacks: true,
		URLhashListener: true,
		autoPlay: true,
		autoPlaySpeed: 1000,
		autoPlayTimeout: 1000,
		autoplayHoverPause: false
	});
	$(document).on('closing', '#remodal-video', function (e) {
		$("#remodal-video iframe").attr("src", $("#remodal-video iframe").attr("src"));
	});
</script>
@endsection
