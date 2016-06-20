@extends('admin.layouts.app')
@section('page.title', 'Add Advertisement')
@section('page.description', 'Add a new Advertisement')
@section('page.breadcrumb')
    <li><a href="#">Advertisements</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">New Advertisements</h3>
        </div>
        {!! Form::open(['url' => route('backend.admin.advertisements.store'), 'files' => true]) !!}
            @include('admin.advertisements._form')
        {!! Form::close() !!}
    </div>
@stop