@extends('corporate.layouts.app', ['suppressAlerts' => true])
@section('page.title', 'Edit Listing')
@section('page.description', 'Update a listing information')
@section('page.breadcrumb')
    <li><a href="#">Services</a></li>
    <li><a href="{{ route('backend.corporate.listings.index', $service->id) }}">{{ $service->name }}</a></li>
    <li>Edit</li>
@stop

@section('content')
    @if($errors->count())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Whoops!</h4><small>Please, make sure all fields meet the requirements</small>
        </div>
    @endif

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Listing</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($listing, ['method' => 'PATCH', 'url' => route('backend.corporate.listings.update', [$service->id, $listing->id])]) !!}
            @include('corporate.listings._form')
        {!! Form::close() !!}
    </div>
@stop