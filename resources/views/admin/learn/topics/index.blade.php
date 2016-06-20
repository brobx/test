@extends('admin.layouts.app')
@section('page.title', $service->name . " Topics")
@section('page.description')
    <a href="{{ route('backend.admin.learn.topics.create', $service->id) }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">{{ $service->name }} Topics</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $service->name }} Topics</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Title (Arabic)</th>
                    <th>Priority</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($topics as $topic)
                    <tr>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->translate('ar')->title }}</td>
                        <td>{{ $topic->priority or '---' }}</td>
                        <td>{{ $topic->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.admin.learn.topics.edit', [$service->id, $topic->id]) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $topic->id,
                                'title' => $topic->title,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.learn.topics.destroy', [$service->id, $topic->id])
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $topics->render() !!}
            </div>
        </div>
    </div>
@stop