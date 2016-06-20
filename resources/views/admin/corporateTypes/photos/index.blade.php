@extends('admin.layouts.app')
@section('page.title', 'Slides')
@section('page.description')
    <a href="{{ route('backend.admin.corporate-types.photos.create', $type->slug) }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">{{ $type->title }} Slides</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $type->title }} Slides</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($slides as $slide)
                    <tr>
                        <td><img src="{{ imagePath($slide->name) }}" height="100" width="100" class="img-responsive" alt="{{ $slide->caption }}"></td>
                        <td>{{ $slide->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.admin.corporate-types.photos.edit', [$type->slug, $slide->id]) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $slide->id,
                                'title' => $slide->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.corporate-types.photos.destroy', [$type->slug, $slide->id])
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $slides->render() !!}
            </div>
        </div>
    </div>
@stop