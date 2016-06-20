@extends('admin.layouts.app')
@section('page.title', 'Edit Advertisement')
@section('page.description', 'Update an Advertisement')
@section('page.breadcrumb')
    <li><a href="#">Advertisements</a></li>
    <li class="active">Edit</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Advertisement</h3>
        </div>
        {!! Form::model($ad, ['method' => 'PATCH', 'files' => true, 'url' => route('backend.admin.advertisements.update', $ad->id)]) !!}
            @include('admin.advertisements._form')
        {!! Form::close() !!}
    </div>
@stop