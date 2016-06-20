@extends('master')
@section('page.title', 'Qarenhom')

@section('content')
<section id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>{{ $question->translate()->question }}</h4>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">{{ trans('main.home') }}</a></li>
                    <li><a href="{{ route('help.index') }}">{{ trans('main.help') }}</a></li>
                    <li class="active">{{ $question->translate()->question }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="help">
    <div class="container">
        {!! $question->translate()->answer !!}

        <div class="back text-center">
            <a href="{{ route('help.index') }}" class="section-back" data-toggle="tooltip"
               data-placement="bottom"
               title="Go Back"
            >
                <i class="fa fa-arrow-left"></i>
                @lang('main.backToHelp')
            </a>
        </div>
    </div>
</section>

<section class="help-contact">
    <div class="container text-center">
        <h3>@lang('main.cannotFind')</h3>
        <a href="/contact" class="btn btn-trans">{{ trans('main.contactUs') }}</a>
    </div>
</section>
@endsection
