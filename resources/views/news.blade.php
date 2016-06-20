@extends('master')

@section('page.title')
@lang('main.news')
@stop

@section('content')

@include('components/breadcrumb', [
	'title'  => trans('main.news'),
	'levels' => [
		['title' => trans('main.news'), 'url' => '']
	]
])

<section class="news gray">
	<div class="container">
		@if($ad)
		<a href="{{ route('out', $ad->id) }}" target="_blank">
			<div class="text-center">
				<img src="/uploads/{{ $ad->translate()->image }}" id="ads-image">
			</div>
		</a>
		@endif
		<div class="news-wrapper">
			<div class="row">
				@foreach($categories as $category)
				<div class="col-md-6">
					<div class="news-box">
						<h3 class="category-title">{{$category->translate()->title}}</h3>
						@foreach($category->posts as $post)
						<div class="post">
							<div class="news-title">
								<a href="{{route('news.show', $post->id)}}">
									<h4 class="blue">{{$post->translate()->title}}</h4>
								</a>
							</div>
							<div class="news-info">
								<span>{{trans('main.postedAt')}} {{date('j M. Y', strtotime($post->created_at))}}</span>
							</div>
							<div class="news-excerpts">
								<p>{{mb_substr(strip_tags($post->translate()->body), 0, 250)}}...</p>
							</div>
						</div>
						@endforeach
					</div>
					<a href="{{ route('news.category.index', $category->id) }}" class="btn btn-trans"><h5>@lang('main.readmore')</h5></a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

@endsection
