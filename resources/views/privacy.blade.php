@extends('master')

@section('page.title')
@lang('main.privacy')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.privacy'), 'levels' => [['title' => trans('main.privacy'), 'url' => ''] ] ])`


<section class="privacy">
	<div class="container">
		<p>Qarenhom, including its affiliates (Qarenhom), collects, stores, and uses your personal information as a data controller in connection with and in order to provide and develop Rovio’s products, mobile applications, services and websites (together “Services”) according to this privacy policy (“Privacy Policy”).</p>
		<p>For questions and information about Privacy Policy and data subject's rights, please contact us at privacy[at]rovio.com or alternatively at Rovio Entertainment Ltd, Legal Department, Keilaranta 17 C, 02150 Espoo, Finland.</p>
		<p>For information about our privacy practices related to data from children, please see “Special Note About Children’s Privacy” below.</p>
		<p><b>All Qarenhom Services are governed by this Privacy Policy and by using or accessing a Service You give consent to the processing, use and disclosure of your data. Please do not install or use the Services if you do not agree to this Privacy Policy.</b></p>
		<p>Qarenhom reserves the right to modify this Privacy Policy. Your continued use of Services will signify your acceptance of the changes to this Privacy Policy.</p>
		
		<div class="band">
			<h4 class="blue band-title">1. How We Collect Your data</h4>
			<p>Likely situations when you make personal data available to Rovio include, but are not limited to: (i) by using Rovio’s mobile apps or visiting our websites, (ii) registration for Services, contests and special events; (iii) accessing Services using a third party ID, such as social networking sites or gaming services; (iv) subscribing to newsletters; (v) purchasing a product or services through Rovio’s online stores or within the app (or "in-app purchase"); (vi) using “tell a friend,” "email this page," or other similar features; (vii) requesting technical support; and (viii) otherwise through use of Rovio Services where personal data is required for use and/or participation.</p>
			<p>The data we process on you may include, but is not limited to: email address, device ID, IP-address, user names and passwords.</p>
		</div>
		<div class="band">
			<h4 class="blue band-title">1. Ad Serving Technology</h4>
			<p>Rovio reserves the right to use and disclose the collected, non-personal data for purposes of advertising by Rovio or Rovio’s partners and contractors.</p>
			<p>Rovio may employ third party ad serving technologies that use certain methods to collect information as a result of ad serving through Services.</p>
			<p>Rovio or third parties operating the ad serving technology may use demographic and geo-location information (for more information regarding use of Location Data see below Section 3) as well as information logged from your hardware or device to ensure that relevant advertising is presented within the Service. Rovio or third parties may collect and use data, for such purposes, including but not limited to, data such as IP address, Device ID, MAC address, installed software, application usage data, hardware type, Operating System information, browser information, unique identifiers in browser cookies, Flash cookies, and HTML5 local storage, Internet and on-line usage information and in-game information.</p>
			<p>Additionally please note that if you “opt out” it does not mean that you will no longer receive advertising. It just means that the advertising you see displayed will not be customized to you and your interests and may be less relevant to you.</p>
		</div>
	</div>
</section>

@endsection