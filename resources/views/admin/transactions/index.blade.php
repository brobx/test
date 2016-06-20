@extends('admin.layouts.app')
@section('page.title', 'Transactions')
@section('page.description')
    Most recent transactions
@stop
@section('page.breadcrumb')
    <li class="active">Transactions</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Transactions</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Fort Id</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name or '---' }}</td>
                        <td>{{ number_format($transaction->amount) }} EGP</td>
                        <td>{{ $transaction->fort_id or '---' }}</td>
                        <td>{!! $transaction->present()->status !!}</td>
                        <td>{!! $transaction->present()->method !!}</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $transactions->render() !!}
            </div>
        </div>
    </div>
@stop
