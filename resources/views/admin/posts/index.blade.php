@extends('admin.layouts.app')
@section('page.title', 'News and Posts')
@section('page.description')
    <a href="{{ route('backend.admin.posts.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">Posts</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Posts</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Created By</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name or '---' }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.admin.posts.edit', $post->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $post->id,
                                'title' => $post->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.posts.destroy', $post->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $posts->render() !!}
            </div>
        </div>
    </div>
@stop