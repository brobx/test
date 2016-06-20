@extends('admin.layouts.app')
@section('page.title', 'Edit FAQ')
@section('page.description', 'Update FAQ')
@section('page.breadcrumb')
    <li><a href="#">FAQs</a></li>
    <li class="active">Edit</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit FAQ</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::model($faq, ['method' => 'PATCH', 'url' => route('backend.admin.faqs.update', $faq->id)]) !!}
            @include('admin.faqs._form')
        {!! Form::close() !!}
    </div>
@stop