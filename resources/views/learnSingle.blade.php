@extends('master')

@section('page.title')
@lang('main.learn')
@stop

@section('content')

    @include('components/breadcrumb', [ 'title' => trans('main.learn'), 'levels' => [['title' => trans('main.learn'), 'url' => route('learn.index')], ['title' => $service->translate()->name, 'url' => '']] ])

    <section class="learnSingle gray acc">
        <div class="container">
            <div class="col-md-7">
                <div class="singleListing-box border-bottom">
                    <h3 class="singleListing-title blue">{{ $service->translate()->name }}</h3>
                    <div class="panel-group" id="accordion">
                        @foreach($service->topics as $topic)
                            <div class="panel panel-default">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne-{{ $topic->id }}">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                                {{ $topic->translate()->title }}
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseOne-{{ $topic->id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        {!! $topic->translate()->body !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="singleListing-sidebar">
                    <div class="singleListing-slider">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @foreach($service->photos as $index => $slide)
                                    <div class="item {{ ! $index ? 'active' : '' }}">
                                        <img src="{{ imagePath($slide->name) }}"
                                             alt="{{ $slide->translate()->caption }}">
                                        <div class="carousel-caption">
                                            {{ $slide->translate()->caption }}
                                        </div>
                                    </div>
                                    @endforeach
                                            <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button"
                                       data-slide="prev">
                                        <img src="/assets/img/arrow-left.png" class="img-responsive" id="img-left">
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button"
                                       data-slide="next">
                                        <img src="/assets/img/arrow-right.png" class="img-responsive" id="img-right">
                                        <span class="sr-only">Next</span>
                                    </a>
                            </div>
                            <div class="singleListing-btns">
                                <a href="{{ route('services.listings', $service->id) }}" class="btn btn-trans">{{ trans('main.compare') }}</a>
                            </div>
                        </div>
                        @if($service->video_url)
                            <div class="video">
                                <div class="video-shadow">
                                    <a href="#" data-remodal-target="modalVideo">
                                        <img src="/assets/img/home-loan.jpg" class="img-responsive" id="video-thumb">
                                        <div class="play-icon">
                                            <img src="/assets/img/icon-play.png" class="play-icon-img">
                                        </div>
                                    </a>
                                    <div id="remodal-video" class="remodal video" data-remodal-id="modalVideo"
                                         data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
                                        <button data-remodal-action="close" class="remodal-close"></button>
                                        <iframe width="100%" height="100%" src="{{ $service->video_url }}"
                                                frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')
    <script>
        $('.collapse').collapse("hide");
        $(document).on('closing', '#remodal-video', function (e) {
            $("#remodal-video iframe").attr("src", $("#remodal-video iframe").attr("src"));
        });
    </script>
@endsection
