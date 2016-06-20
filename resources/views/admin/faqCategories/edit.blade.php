@extends('admin.layouts.app')
@section('page.title', 'Edit FAQ Category')
@section('page.description', 'Update FAQ Category')
@section('page.breadcrumb')
    <li><a href="#">FAQ Categories</a></li>
    <li class="active">Edit</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit FAQ Category</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($category, ['method' => 'PATCH', 'url' => route('backend.admin.faq-categories.update', $category->id)]) !!}
            @include('admin.faqCategories._form')
        {!! Form::close() !!}
    </div>
@stop