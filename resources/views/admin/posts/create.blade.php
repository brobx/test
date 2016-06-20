@extends('admin.layouts.app')
@section('page.title', 'Create Post')
@section('page.description', 'Add a new post')
@section('page.breadcrumb')
    <li><a href="#">Posts</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Post</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.admin.posts.store'), 'files' => true]) !!}
            @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
@stop