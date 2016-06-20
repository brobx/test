@extends('master')
@section('page.title', 'News - Qarenhom')

@section('content')

    @include('components/breadcrumb', [
	'title'  => trans('main.news'),
        'levels' => [
            ['title' => trans('main.news'), 'url' => ''],
        ]
    ])

    <section class="news gray">
        <div class="container">
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-md-10">
                        <div class="news-box">
                            @foreach($category->posts as $post)
                                <div class="post">
                                    <div class="news-title">
                                        <a href="{{route('news.show', $post->id)}}">
                                            <h4 class="blue">{{$post->translate()->title}}</h4>
                                        </a>
                                    </div>
                                    <div class="news-info">
                                        <span>{{trans('main.postedAt')}} {{date('j M. Y', strtotime($post->created_at))}}</span>
                                    </div>
                                    <div class="news-excerpts">
                                        <p>{{mb_substr(strip_tags($post->translate()->body), 0, 250)}}...</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
