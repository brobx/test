@extends('corporate.layouts.app')
@section('page.title', 'Edit Slide')
@section('page.description', 'Update a slide information')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.sliders.index') }}">Slider</a></li>
    <li class="active">Edit Slide</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Slide</h3>
        </div>

        {!! Form::model($slider, ['method' => 'PATCH', 'url' => route('backend.corporate.sliders.update', $slider->id), 'files' => true]) !!}
        <div class="box-body">
            <!-- description Form Input -->
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
            </div>

            <!-- description arabic Form Input -->
            <div class="form-group">
                {!! Form::label('description_ar', 'Description (Arabic)') !!}
                {!! Form::textarea('description_ar', $slider->translate('ar')->description, ['class' => 'form-control', 'rows' => 3, 'dir' => "auto"]) !!}
            </div>

            <image-upload name="image" file-name="{{ imagePath($slider->image) }}"></image-upload>
        </div>

        <div class="box-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop