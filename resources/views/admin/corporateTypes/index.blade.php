@extends('admin.layouts.app')
@section('page.title', 'Corporate Types')
@section('page.description', 'Those Slides will appear in the quick search pages respectively.')
@section('page.breadcrumb')
    <li class="active">Corporate Types</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Corporate Types</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->title }}</td>
                        <td>
                            <a href="{{ route('backend.admin.corporate-types.photos.index', $type->slug) }}"
                               class="btn btn-primary btn-xs btn-flat"
                            >
                                <i class="fa fa-photo"></i> Manage Slides
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop