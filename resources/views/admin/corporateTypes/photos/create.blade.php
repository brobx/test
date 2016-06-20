@extends('admin.layouts.app')
@section('page.title', 'Create Slide')
@section('page.description', 'Add a new Slide to the corporate type')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.admin.corporate-types.photos.index', $type->slug) }}">{{ $type->title }} Slides</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    {!! Form::open(['url' => route('backend.admin.corporate-types.photos.store', $type->slug)]) !!}
        <slider-upload message="* Dimensions: 722px × 519px" name="image" url="{{ route('backend.admin.images.slider') }}" :has-title="true"></slider-upload>
    {!! Form::close() !!}
@stop