@extends('corporate.layouts.app')
@section('page.title', 'Profile')
@section('page.description', 'Profile')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Update Profile</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($signedUser, ['url' => route('backend.corporate.settings.profile.save')]) !!}
        <div class="box-body">
            <!-- name Form Input -->
            <div class="form-group">
                {!! Form::label('name', 'Full Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <toggled-field hide-text="Cancel" show-text="Change Email/Password">
                <!-- email Form Input -->
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <!-- password Form Input -->
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'value' => '']) !!}
                </div>

                <!-- password_confirmation Form Input -->
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm password') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'value' => '']) !!}
                </div>
            </toggled-field>

        </div>
        <div class="box-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop