@extends('admin.layouts.app')
@section('page.title', 'Edit Topic')
@section('page.description', 'Update Topic')
@section('page.breadcrumb')
    <li><a href="#">Topics</a></li>
    <li class="active">Edit</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Topic</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($topic, ['method' => 'PATCH', 'url' => route('backend.admin.learn.topics.update', [$service->id, $topic->id])]) !!}
            @include('admin.learn.topics._form')
        {!! Form::close() !!}
    </div>
@stop