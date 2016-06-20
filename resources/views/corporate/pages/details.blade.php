@extends('corporate.layouts.app')
@section('page.title', 'Details')
@section('page.description', 'Update ' . $corporate->name . ' Information')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Details</h3>
        </div>
        {!! Form::model($details, ['url' => route('backend.corporate.details.save'), 'files' => true]) !!}
        <div class="box-body">
            <!-- website Form Input -->
            <div class="form-group">
                {!! Form::label('website', 'Website') !!}
                {!! Form::text('website', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Enquires Email Form Input -->
            <div class="form-group">
                {!! Form::label('email', 'Enquires Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Call Center Email Form Input -->
            <div class="form-group">
                {!! Form::label('call_center_email', 'Call center email') !!}
                {!! Form::text('call_center_email', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Phone Form Input -->
            <div class="form-group">
                {!! Form::label('phone', 'Call Center') !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>

            <!-- description Form Input -->
            <div class="form-group">
                {!! Form::label('description', 'Description (English)') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
            </div>

            <!-- description Form Input -->
            <div class="form-group">
                {!! Form::label('description_ar', 'Description (Arabic)') !!}
                {!! Form::textarea('description_ar', isset($details) ? $details->translate('ar')->description : null, ['class' => 'form-control', 'rows' => 4, 'dir' => "auto"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('logo', 'Logo') !!}
                <image-upload message="* Dimensions: 333px × 100px" name="logo" url="{{ route('backend.corporate.images.add') }}" file-name="{{ old('logo') ? old('logo') : (isset($details) ? $details->logo : '') }}"></image-upload>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
