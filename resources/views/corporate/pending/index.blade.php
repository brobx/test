@extends('corporate.layouts.app')
@section('page.title', 'Data Requests')
@section('page.description')
    Review Data Requests By the Data Entry Users
@stop
@section('page.breadcrumb')
    <li class="active">Data Requests</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Service Type</th>
                    <th>Type</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendingModels as $model)
                    <tr>
                        @if($model->pending_type === 'App\Listing')
                            <td>{{ $model->pendingModel->service->type->title or '---'}}</td>
                        @else
                            <td>---</td>
                        @endif
                            <td>{{ $model->type }}</td>
                        <td>{{ $model->user->name }}</td>
                        <td>{{ $model->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.corporate.data.requests.show', $model->id) }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Preview</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $pendingModels->render() !!}
            </div>
        </div>
    </div>
@stop