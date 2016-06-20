@extends('master')
@section('page.title', trans('main.help'))

@section('content')
<section class="intro help">
    <section class="section-wrapper">
        <div class="container table">
            <div class="intro-content">
                <h2 class="section-title">{{trans('main.howCanWeHelp')}}</h2>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <search-help no-hits-msg="{{ trans('main.noHits') }}" placeholder="{{trans('main.searchHelp')}}"></search-help>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</section>

<section class="help">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($faqs as $faq)
                <div class="row item">
                    <div class="col-md-3">
                        <h3>{{ $faq->translate()->title }}</h3>
                    </div>
                    <div class="col-md-9">
                        <ul>
                            @foreach($faq->questions as $question)
                            <li><a href="{{ route('help.show', $question->id) }}">{{ $question->translate()->question }}</a></li>
                            @endforeach
                            <!-- <li class="see-all"><a href="#">See all</a></li> -->
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="help-contact">
    <div class="container text-center">
        <h3>{{ trans('main.cantFind') }}</h3>
        <a href="{{ route('contact') }}" class="btn btn-trans">{{ trans('main.contactUs') }}</a>
    </div>
</section>
@endsection
