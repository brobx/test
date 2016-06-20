@extends('admin.layouts.app')
@section('page.title', 'Edit Slide')
@section('page.description', 'Update a slide information')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.admin.learn.photos.index', $service->id) }}">{{ $service->name }} Slides</a></li>
    <li class="active">Edit Slide</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Slide</h3>
        </div>

        {!! Form::model($photo, ['method' => 'PATCH', 'url' => route('backend.admin.learn.photos.update', [$service->id, $photo->id]), 'files' => true]) !!}
        <div class="box-body">
            <!-- description Form Input -->
            <div class="form-group">
                {!! Form::label('caption', 'Caption') !!}
                {!! Form::textarea('caption', null, ['class' => 'form-control', 'rows' => 3]) !!}
            </div>

            <!-- description arabic Form Input -->
            <div class="form-group">
                {!! Form::label('caption_ar', 'Caption (Arabic)') !!}
                {!! Form::textarea('caption_ar', $photo->translate('ar')->caption, ['class' => 'form-control', 'rows' => 3, 'dir' => "auto"]) !!}
            </div>

            <image-upload name="name" url="{{ route('backend.corporate.images.add') }}" file-name="{{ old('name') ? old('name') : $photo->name }}"></image-upload>
        </div>

        <div class="box-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
