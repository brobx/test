@extends('corporate.layouts.app')
@section('page.title', 'Create Branch')
@section('page.description', 'Add a new Branch')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.branches.index') }}">Branches</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Branch</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.corporate.branches.store')]) !!}
            @include('corporate.branches._form')
        {!! Form::close() !!}
    </div>
@stop