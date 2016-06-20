@extends('admin.layouts.app')
@section('page.title', 'Create FAQ')
@section('page.description', 'Add a FAQ')
@section('page.breadcrumb')
    <li><a href="#">FAQs</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add FAQ</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.admin.faqs.store')]) !!}
            @include('admin.faqs._form')
        {!! Form::close() !!}
    </div>
@stop