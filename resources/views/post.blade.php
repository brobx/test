@extends('master')

@section('page.title')
@lang('main.news')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.news'), 'levels' => [['title' => trans('main.news'), 'url' => route('news.index')], ['title' => $post->translate()->title, 'url' => '']] ])

<section class="news post gray">
	<div class="container">
		@if(isset($ad))
		<a href="{{ route('out', $ad->id) }}" target="_blank">
			<img src="/uploads/{{ $ad->translate()->image }}" class="img-responsive">
		</a>
		@endif
		<div class="news-wrapper post-wrapper">
			<div class="news-box post-box">
				<div class="news-title">
					<h2 class="blue">{{$post->translate()->title}}</h2>
				</div>
				<div class="news-info">
					<span>{{trans('main.postedAt')}} {{date('j M. Y', strtotime($post->created_at))}}</span>
				</div>
				<div class="post-image">
					<img src="{{ imagePath($post->image) }}" class="img-responsive" alt="">
				</div>
				<div class="post-body">
					{!! $post->translate()->body !!}
				</div>
				<div class="singleListing-social post-social">
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
</section>

@endsection