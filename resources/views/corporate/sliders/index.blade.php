@extends('corporate.layouts.app')
@section('page.title', 'Slider')
@section('page.description')
    <a href="{{ route('backend.corporate.sliders.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">Sliders</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Slider Images</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($sliders as $slider)
                    <tr>
                        <td><img src="{{ imagePath($slider->image) }}" class="img-responsive" width="100" height="100" alt=""></td>
                        <td>{{ $slider->description or '---' }}</td>
                        <td>{{ $slider->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.corporate.sliders.edit', $slider->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $slider->id,
                                'title' => 'Delete Slider Image',
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.corporate.sliders.destroy', $slider->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $sliders->render() !!}
            </div>
        </div>
    </div>
@stop