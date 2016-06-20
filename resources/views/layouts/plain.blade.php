<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>@yield('page.title')</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/css/remodal.css">
	<link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
	<link rel="stylesheet" href="/assets/css/nouislider.min.css">
	<link rel="stylesheet" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="/assets/css/owl.theme.css">
	@include('components.favicon')
	<link rel="stylesheet" href="/assets/css/style.css">
	@if(config('app.locale') == 'ar')
	<link rel="stylesheet" href="/assets/css/style-rtl.css">
	@endif
	
	@yield('css')
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


	<section class="plain">
		<div class="plain-content">@yield('content')</div>
	</section>


	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/nouislider.min.js"></script>
	<script src="/assets/js/remodal.min.js"></script>
	<script src="/assets/js/owl.carousel.js"></script>
	<script src="/assets/js/script.js"></script>
	@yield('scripts')
</body>
</html>