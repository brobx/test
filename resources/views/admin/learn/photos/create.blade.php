@extends('admin.layouts.app')
@section('page.title', 'Create Slide')
@section('page.description', 'Add a new Slide to the service')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.admin.learn.photos.index', $service->id) }}">{{ $service->name }} Slides</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    {!! Form::open(['url' => route('backend.admin.learn.photos.store', $service->id)]) !!}
        <slider-upload name="image" url="{{ route('backend.admin.images.slider') }}"></slider-upload>
    {!! Form::close() !!}
@stop