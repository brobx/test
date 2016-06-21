@extends('master')

@section('page.title')
@lang('main.qarenhom')
@stop

@section('content')
<section class="intro">
    <section class="section-wrapper">
        <div class="container table">
            <div class="intro-content">
                <h2 class="section-title">{{trans('main.introHome')}}</h2>
                <div class="row">
                    <div class="col-md-4 dots">
                        <button class="circle-btn">
                            <div class="circle-item">
                                <a href="{{ route('industries.show', 'banking') }}">
                                    <h2>{{trans('main.banking')}}</h2>
                                </a>
                            </div>
                        </button>
                    </div>
                    <div class="col-md-4 dots">
                        <button class="circle-btn">
                            <div class="circle-item">
                                <a href="{{ route('industries.show', 'broadband') }}">
                                <h2>{{trans('main.mobilePhone')}}</h2>
                                </a>
                            </div>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="circle-btn">
                            <div class="circle-item">
                                <a href="{{ route('industries.show', 'travel') }}">
                                <h2>{{trans('main.travel')}}</h2>
                                </a>
                            </div>
                        </button>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</section>

<section class="about home">
    <div class="container">
        <div class="about-qarenhom">
            <h2 class="section-title">{{trans('main.about')}}</h2>
            <p>{{trans('main.aboutDesc')}}</p>
        </div>
    </div>
</section>

<section class="howIt-works text-center">
    <section class="section-wrapper">
        <div class="container">
            <h2 class="section-title">{{trans('main.howItWorks')}}</h2>
            <p class="howIt-desc">{{trans('main.howItWorksDesc')}}</p>
            <div class="how-btns">
                <a href="#" class="btn btn-trans" data-remodal-target="modalVideo">{{trans('main.playVideo')}}</a>
                <a href="/about" class="btn btn-trans orange">{{trans('main.findMore')}}</a>
            </div>
        </div>
    </section>
    <div class="remodal video" data-remodal-id="modalVideo" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <iframe width="100%" height="100%" src="http://www.youtube.com/embed/I5dUlac3Uis" frameborder="0" allowfullscreen></iframe>
    </div>
</section>

<section class="services home">
    <div class="container">
        <h2 class="section-title">{{trans('main.services')}}</h2>
        @foreach($servicesTypes as $serviceType)
        <div class="service">
            <h4 class="services-title">{{$serviceType->translate()->title}}</h4>
            <ul class="services-icons">
                @foreach($serviceType->services as $service)
                <li>
                    <a href="{{ route('services.listings', $service->id) }}" class="service-icon-btn">
                        <img src="/assets/img/services/{{$service->icon}}.png" class="service-icon">
                        <p class="service-name">{{$service->translate()->name}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</section>
@endsection
