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
	<link rel="stylesheet" href="/assets/css/style.css">
	@if(config('app.locale') == 'ar')
	<link rel="stylesheet" href="/assets/css/style-rtl.css">
	@endif
	@yield('css')
</head>
<body>
	@yield('content')
</body>
</html>
