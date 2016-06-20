@extends('admin.layouts.app')
@section('page.title', 'Log')
@section('page.description')
    @include('admin.modals.delete', [
        'id' => '1',
        'title' => 'Log',
        'body' => 'This Cannot be undone',
        'route' => route('backend.admin.logs.destroy')
    ])
@stop
@section('page.breadcrumb')
    <li>Logs</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Listings</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Message</th>
                    <th>User</th>
                    <th>Time</th>
                    <th>IP</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->message }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->ip }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $logs->render() !!}
            </div>
        </div>
    </div>
@stop