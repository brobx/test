@extends('admin.layouts.app')
@section('page.title', 'Add Corporate')
@section('page.description', 'Add a new corporate')
@section('page.breadcrumb')
    <li><a href="#">Corporates</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">New Corporate</h3>
        </div>
        {!! Form::open(['url' => route('backend.admin.corporates.store')]) !!}
            @include('admin.corporates._form')
        {!! Form::close() !!}
    </div>
@stop