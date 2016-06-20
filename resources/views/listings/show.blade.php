@extends('master')
@section('page.title', $listing->translate()->name)

@section('content')

@include('components.breadcrumb', ['title' => $listing->translate()->name, 'levels' => [
		['title' => $listing->corporate->type->translate()->title, 'url' => route('industries.show', $listing->corporate->type->slug)],
		['title' => $listing->corporate->translate()->name, 'url' => route('corporates.show', $listing->corporate_id)],
		['title' => $listing->service->translate()->name, 'url' => route('services.listings', $listing->service_id)],
		['title' => $listing->translate()->name, 'url' => ''],
	]
])

<section class="singleListing gray acc">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="singleListing-box border-bottom">
					<h3 class="singleListing-title blue">{{ $listing->translate()->name }}</h3>
					<div class="listing-rating">
						@for($i = 0; $i < $listing->averageRating; $i++)
			                <i class="fa fa-star fa-2x"></i>
			            @endfor
			            @for($i = 0; $i < 5 - $listing->averageRating; $i++)
			                <i class="fa fa-star-o fa-2x"></i>
			            @endfor
					</div>
					<p class="singleListing-desc">
						{!! nl2br($listing->translate()->overview) !!}
					</p>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.highlights')
									</h4>
								</div>
							</a>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									@foreach($listing->highlights as $highlight)
										<p class="singleListing-details">{{ $highlight->translate()->name }}: {{ $highlight->present()->value }}</p>
									@endforeach
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.offers')
									</h4>
								</div>
							</a>
							<div id="collapseTwo" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>{!! nl2br($listing->translate()->offers) !!}</p>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.productDetails')
									</h4>
								</div>
							</a>
							<div id="collapseThree" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>{!! nl2br($listing->translate()->details) !!}</p>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.eligibility')
									</h4>
								</div>
							</a>
							<div id="collapseFour" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>{!! nl2br($listing->translate()->eligibility) !!}</p>
								</div>
							</div>
						</div>

						@if($listing->translate()->benefits)
						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.benefits')
									</h4>
								</div>
							</a>
							<div id="collapseFive" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>{!! nl2br($listing->translate()->benefits) !!}</p>
								</div>
							</div>
						</div>
						@endif

						@if($listing->translate()->documents)
						<div class="panel panel-default">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
								<div class="panel-heading">
									<h4 class="panel-title">
										@lang('main.documents')
									</h4>
								</div>
							</a>
							<div id="collapseSix" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>{!! nl2br($listing->translate()->documents) !!}</p>
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="singleListing-sidebar">
					<div class="singleListing-slider">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								@foreach($listing->photos as $index => $photo)
									<div class="item {{ ! $index ? 'active' : ''}}">
										<img src="{{ imagePath($photo->name) }}" alt="{{ $photo->translate()->caption }}">
										<div class="carousel-caption">
											{{ $photo->translate()->caption }}
										</div>
									</div>
								@endforeach
							</div>
							<!-- Controls -->
							<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
								<img src="/assets/img/arrow-left.png" class="img-responsive" id="img-left">
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
								<img src="/assets/img/arrow-right.png" class="img-responsive" id="img-right">
								<span class="sr-only">Next</span>
							</a>
						</div>
						<div class="singleListing-btns">
			                <a href="" class="btn btn-trans pull-left" data-remodal-target="modalVideo">{{trans('main.playVideo')}}</a>
			                <a href="{{ route('services.listings', $listing->service->id) }}" class="btn btn-trans orange pull-right">{{trans('main.findMore')}}</a>
			            </div>
			            <div class="remodal video" data-remodal-id="modalVideo" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
					        <button data-remodal-action="close" class="remodal-close"></button>
					        <iframe width="100%" height="100%" src="http://www.youtube.com/embed/I5dUlac3Uis" frameborder="0" allowfullscreen></iframe>
					    </div>
					</div>
					<div class="singleListing-social">
						<h3 class="blue">{{ trans('main.shareOn') }}</h3>
						<div class="share-social">
							<a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Post on Facebook"><i class="fa fa-facebook fa-2x"></i></a>
							<a href="https://twitter.com/home?status={{Request::url()}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Share on Twitter"><i class="fa fa-twitter fa-2x"></i></a>
							<a href="https://plus.google.com/share?url={{Request::url()}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Share on Google Plus"><i class="fa fa-google-plus fa-2x"></i></a>
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
	$('.collapse').collapse("hide");
</script>
@endsection
