@extends('admin.layouts.app')
@section('page.title', 'Create FAQ Category')
@section('page.description', 'Add a FAQ Category')
@section('page.breadcrumb')
    <li><a href="#">FAQ Categories</a></li>
    <li class="active">Add New</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add FAQ Category</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['url' => route('backend.admin.faq-categories.store')]) !!}
            @include('admin.faqCategories._form')
        {!! Form::close() !!}
    </div>
@stop