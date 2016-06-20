<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>@yield('page.title')</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	@if(config('app.locale') == 'ar')
	<link rel="stylesheet" href="/assets/css/bootstrap-rtl.min.css">
	@endif
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/css/frontend.css">
	<link rel="stylesheet" href="/assets/css/remodal.css">
	<link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
	<link rel="stylesheet" href="/assets/css/nouislider.min.css">
	<link rel="stylesheet" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="/assets/css/owl.theme.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	@if(config('app.locale') == 'ar')
	<link rel="stylesheet" href="/assets/css/style-rtl.css">
	@endif
	@yield('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@include('components.favicon')
</head>
<body>

	@include('layouts.navbar')

	@yield('content')

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="footer-list">
						<ul>
							<li><a href="{{ route('home') }}">{{ trans('main.home') }}</a></li>
							<li><a href="{{ route('industries.show', 'banking') }}">{{ trans('main.banking') }}</a></li>
							<li><a href="{{ route('industries.show', 'broadband') }}">{{ trans('main.mobile_broadband') }}</a></li>
							<li><a href="{{ route('industries.show', 'travel') }}">{{ trans('main.travel') }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list">
						<ul>
							<li><a href="{{ locale_url('learn') }}">{{ trans('main.learn') }}</a></li>
							<li><a href="{{ route('tools.index') }}">{{ trans('main.tools') }}</a></li>
							<li><a href="{{ locale_url('partners') }}">{{ trans('main.partners') }}</a></li>
							<li><a href="{{ locale_url('news') }}">{{ trans('main.news') }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list">
						<ul>
							<li><a href="{{ route('help.index') }}">{{ trans('main.help') }}</a></li>
							@if(Auth::check())
								<li><a href="{{ action('Auth\AuthController@logout') }}"><i class="fa fa-power-off"></i> {{trans('main.logout')}}</a></li>
							@else
								<li><a href="{{ locale_url('login') }}">{{ trans('main.login') }}</a></li>
								<li><a href="{{ locale_url('register') }}">{{ trans('main.register') }}</a></li>
							@endif
								<li><a href="{{ locale_url('tos') }}">{{ trans('main.terms') }}</a></li>
								<li><a href="{{ locale_url('privacy') }}">{{ trans('main.privacy') }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list brand">
						<ul>
							<li><img src="/assets/img/quadrant.png" width="100px"></li>
							<li>
								<p><i class="fa fa-copyright"></i> 2016 Quadrant.</p>
								<p>{{ trans('main.rights') }}</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	@if(config('app.env') == 'production')
			<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
		window.$zopim || (function (d, s) {
			var z = $zopim = function (c) {
				z._.push(c)
			}, $ = z.s =
					d.createElement(s), e = d.getElementsByTagName(s)[0];
			z.set = function (o) {
				z.set._.push(o)
			};
			z._ = [];
			z.set._ = [];
			$.async = !0;
			$.setAttribute('charset', 'utf-8');
			$.src = '//v2.zopim.com/?3gNJnv6aszkivnOvIXtpvOXJIPEJ9mxE';
			z.t = +new Date;
			$.type = 'text/javascript';
			e.parentNode.insertBefore($, e)
		})(document, 'script');
	</script>
	<!--End of Zopim Live Chat Script-->
	@endif
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/nouislider.min.js"></script>
	<script src="/assets/js/remodal.min.js"></script>
	<script src="/assets/js/owl.carousel.js"></script>
	<script src="/assets/js/script.js"></script>
	<script src="/assets/js/frontend.js"></script>
	@yield('scripts')
</body>
</html>