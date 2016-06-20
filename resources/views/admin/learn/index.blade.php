@extends('admin.layouts.app')
@section('page.title', 'Learn')
@section('page.breadcrumb')
    <li class="active">Learn</li>
@stop

@section('content')
    @foreach($corporateTypes as $type)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $type->title }} Services</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Service Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($type->services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>
                                        <a href="{{ route('backend.admin.learn.photos.index', $service->id) }}"
                                           class="btn btn-primary btn-xs"
                                        >
                                            <i class="fa fa-photo"></i>
                                            Slides
                                        </a>
                                        <a href="{{ route('backend.admin.learn.topics.index', $service->id) }}"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-book"></i>
                                            Topics
                                        </a>
                                        @include('admin.learn._video')
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop