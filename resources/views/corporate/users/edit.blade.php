@extends('corporate.layouts.app')
@section('page.title', 'Edit User')
@section('page.description', 'Updates a user information')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.users.index') }}">Users</a></li>
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
        {!! Form::model($user, ['method' => 'PATCH', 'url' => route('backend.corporate.users.update', $user->id)]) !!}
            @include('corporate.users._form')
        {!! Form::close() !!}
    </div>
@stop