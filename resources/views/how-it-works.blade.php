@extends('master')

@section('page.title')
@lang('main.howItWorks')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => 'How It Works', 'levels' => [['title' => 'How It Works', 'url' => ''] ] ])

<section class="how-it-works">
	<div class="container">
		<div class="how-heading text-center">
			<h2>You're Confused?</h2>
			<p>You don't know which bank to choose?<br>which bank offers the best loan for me ?</p>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="how-box">
					<img src="/assets/img/how/1.png" class="img-responsive">
					<h3>Learn more about loans</h3>
					<p>Know more about loans and things to consider before borrowing.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="how-box">
					<img src="/assets/img/how/2.png" class="img-responsive">
					<h3>Compare between banks</h3>
					<p>Know more about your elegibility and required documents to apply.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="how-box">
					<img src="/assets/img/how/3.png" class="img-responsive">
					<h3>Apply on bank website</h3>
					<p><b>1. Request call back: </b>leave your contact details and your selected bank will call you</p>
					<p><b>2. Apply on bank website: </b>go to the website of the selected bank and Fill an application on the bank's website</p>
					<p><b>3. Find a near branch: </b>visit the nearest branch if you prefer to visit in person</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection