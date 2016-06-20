@extends('corporate.layouts.app')
@section('page.title', $service->name . ' Listings')
@section('page.description')
    <a href="{{ route('backend.corporate.listings.create', $service->id) }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li>Services</li>
    <li class="active">{{ $service->name }}</li>
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
                    <th>Name</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listings as $listing)
                    <tr>
                        <td>{{ $listing->name }}</td>
                        <td>{{ $listing->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.corporate.listings.duplicate', [$service->id, $listing->id]) }}" class="btn btn-info btn-xs">
                                <i class="fa fa-copy"></i> Duplicate
                            </a>
                            <a href="{{ route('backend.corporate.listings.edit', [$service->id, $listing->id]) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $listing->id,
                                'title' => $listing->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.corporate.listings.destroy', [$service->id, $listing->id])
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $listings->render() !!}
            </div>
        </div>
    </div>
@stop