@extends('admin.layouts.app')
@section('page.title', 'Create Topic')
@section('page.description', 'Add a new topic')
@section('page.breadcrumb')
    <li><a href="#">Topics</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Topic</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.admin.learn.topics.store', $service->id)]) !!}
            @include('admin.learn.topics._form')
        {!! Form::close() !!}
    </div>
@stop