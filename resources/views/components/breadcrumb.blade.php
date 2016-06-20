<div class="breadcrumb-wrap">
	<div class="container">
		<h2>{{@$title}}</h2>
		<ul class="dir">
			<li><a href="{{ route('home') }}">{{trans('main.home')}}</a></li>
			@if(isset($levels) && is_array($levels))
				@foreach($levels as $level)
					<li><a href="{{ $level['url'] }}">{{ $level['title'] }}</a></li>
				@endforeach
			@endif
		</ul>
	</div>
</div>