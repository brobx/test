@extends('corporate.layouts.app')
@section('page.title', 'Add Slides')
@section('page.description', 'Add images to the sider')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.sliders.index') }}">Slider</a></li>
    <li class="active">Add Slides</li>
@stop

@section('content')
    {!! Form::open(['url' => route('backend.corporate.sliders.store')]) !!}
        <slider-upload name="image" url="{{ route('backend.corporate.images.slider') }}"></slider-upload>
    {!! Form::close() !!}
@stop