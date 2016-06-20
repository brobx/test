@extends('admin.layouts.app')
@section('page.title', 'Edit User')
@section('page.description', 'Updates a user information')
@section('page.breadcrumb')
    <li><a href="#">Users</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit User</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($user, ['method' => 'PATCH', 'url' => route('backend.admin.users.update', $user->id)]) !!}
            @include('admin.users._form')
        {!! Form::close() !!}
    </div>
@stop