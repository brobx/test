@extends('admin.layouts.app')
@section('page.title', 'Edit Corporate')
@section('page.description', 'Update a corporate information')
@section('page.breadcrumb')
    <li><a href="#">Corporates</a></li>
    <li class="active">Edit Corporate</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Corporate</h3>
        </div>
        {!! Form::model($corporate, ['method' => 'PATCH', 'url' => route('backend.admin.corporates.update', $corporate->id)]) !!}
        @include('admin.corporates._form')
        {!! Form::close() !!}
    </div>
@stop