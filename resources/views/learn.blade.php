@extends('master')

@section('page.title')
@lang('main.learn')
@stop

@section('content')

<section class="intro help">
    <section class="section-wrapper">
        <div class="container table">
            <div class="intro-content">
                <h2 class="section-title">{{ trans('main.learnHowItWorks')}}</h2>
            </div>
        </div>
    </section>
</section>

<section class="services">
    <div class="container">
        @foreach($types as $type)
            <div class="service">
                <h4 class="services-title">{{ $type->translate()->title }}</h4>
                <ul class="services-icons">
                    @foreach($type->services as $service)
                        <li>
                            <a href="{{ route('learn.show', $service->id) }}" class="service-icon-btn">
                                <img src="/assets/img/services/{{ $service->icon }}.png" class="service-icon">
                                <p class="service-name">{{ $service->translate()->name }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

@endsection

@section('scripts')

<script>
	$('#learn-tabs').find('a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
</script>

@endsection