@extends('admin.layouts.app')
@section('page.title', 'Invoices')
@section('page.description', 'See Corporates Invoices')

@section('page.breadcrumb')
    <li class="active">Invoices</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">

            <h3 class="box-title">Filters</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['method' => 'GET', 'v-clean']) !!}
            <div class="box-body">
                <div class="col-md-6">
                    <!-- Corporate Form Input -->
                    <div class="form-group">
                        {!! Form::label('corporate', 'Corporate') !!}
                        {!! Form::select('corporate', ['' => 'All'] + $corporates, Request::get('corporate'), ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- payment_status Form Input -->
                    <div class="form-group">
                        {!! Form::label('paid', 'Payment Status') !!}
                        {!! Form::select('paid', ['' => 'All', 'unpaid' => 'Unpaid', 'paid' => 'Paid'], Request::get('paid'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit('Filter', ['class' => 'btn btn-success']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Invoices</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Corporate</th>
                    <th>Date</th>
                    <th>Paid</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->message }}</td>
                        <td>{{ $invoice->billable->name }}</td>
                        <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                        <td><span class="label label-{{ $invoice->paid ? 'success' : 'warning' }}">{{ $invoice->paid ? 'Paid' : 'Unpaid' }}</span></td>
                        <td>{{ number_format($invoice->amount) }}</td>
                        @if(! $invoice->paid)
                            <td>@include('admin.invoices._update')</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $invoices->render() !!}
            </div>
        </div>
    </div>
@stop