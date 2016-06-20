@extends('admin.layouts.app')
@section('page.title', 'Frequently Asked Questions Categories')
@section('page.description')
    <a href="{{ route('backend.admin.faq-categories.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">FAQ Categories</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">FAQ Categories</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.admin.faq-categories.edit', $category->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $category->id,
                                'title' => $category->title,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.faq-categories.destroy', $category->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $categories->render() !!}
            </div>
        </div>
    </div>
@stop