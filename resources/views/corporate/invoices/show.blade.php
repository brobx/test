@extends('corporate.layouts.app')
@section('page.title', 'Invoice')
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.invoices.index') }}">Invoices</a></li>
    <li class="active">Invoice #{{ $invoice->id }}</li>
@stop

@section('content')
    @include('corporate.invoices._invoice')
@stop
