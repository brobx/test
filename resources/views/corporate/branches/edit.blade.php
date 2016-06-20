@extends('corporate.layouts.app')
@section('page.title', 'Edit Branch')
@section('page.description', 'Updates a Branch information')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.branches.index') }}">Branches</a></li>
    <li class="active">Edit Branch</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Branch</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($branch, ['method' => 'PATCH', 'url' => route('backend.corporate.branches.update', $branch->id)]) !!}
            @include('corporate.branches._form')
        {!! Form::close() !!}
    </div>
@stop