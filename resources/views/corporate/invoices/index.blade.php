@extends('corporate.layouts.app')
@section('page.title', 'Invoices')
@section('page.breadcrumb')
    <li class="active">Invoices</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Invoices</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Description</th>
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
                        <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                        <td><span class="label label-{{ $invoice->paid ? 'success' : 'warning' }}">{{ $invoice->paid ? 'Paid' : 'Unpaid' }}</span></td>
                        <td>{{ number_format($invoice->amount) }} EGP</td>
                        <td>
                            <a class="btn btn-xs bg-purple" href="{{ route('backend.corporate.invoices.show', $invoice->id) }}">
                                <i class="fa fa-print"></i>
                                Statement
                            </a>
                        </td>
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