@extends('corporate.layouts.app')
@section('page.title', 'Branches')
@section('page.description')
    <a href="{{ route('backend.corporate.branches.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">Branches</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Branches</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.corporate.branches.edit', $branch->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $branch->id,
                                'title' => $branch->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.corporate.branches.destroy', $branch->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $branches->render() !!}
            </div>
        </div>
    </div>
@stop