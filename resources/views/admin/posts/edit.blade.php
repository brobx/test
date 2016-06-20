@extends('admin.layouts.app')
@section('page.title', 'Edit Post')
@section('page.description', 'Update post')
@section('page.breadcrumb')
    <li><a href="#">Posts</a></li>
    <li class="active">Edit</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Post</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($post, ['method' => 'PATCH', 'url' => route('backend.admin.posts.update', $post->id), 'files' => true]) !!}
            @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
@stop