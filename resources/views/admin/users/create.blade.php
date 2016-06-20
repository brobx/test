@extends('admin.layouts.app')
@section('page.title', 'Create User')
@section('page.description', 'Add a new User')
@section('page.breadcrumb')
    <li><a href="#">Users</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add User</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.admin.users.store')]) !!}
            @include('admin.users._form')
        {!! Form::close() !!}
    </div>
@stop