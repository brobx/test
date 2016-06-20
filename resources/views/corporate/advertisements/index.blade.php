@extends('corporate.layouts.app')
@section('page.title', 'Advertisements')
@section('page.description', 'Displays information about owned ads')
@section('page.breadcrumb')
    <li class="active">Advertisements</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Advertisements</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Preview</th>
                    <th>Is Active</th>
                    <th>Tergeted Impressions</th>
                    <th>Impressions</th>
                    <th>Clicks</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ads as $ad)
                    <tr>
                        <td>{{ $ad->title }}</td>
                        <td><img height="100" width="100" class="img-responsive" src="{{ imagePath($ad->image) }}" alt=""></td>
                        <td>
                            <span class="label label-{{ $ad->isActive() ? 'success' : 'danger' }}">
                                {{ $ad->isActive() ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ number_format($ad->target_impressions) }}</td>
                        <td>{{ number_format($ad->impressions) }}</td>
                        <td>{{ number_format($ad->clicks) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $ads->render() !!}
            </div>
        </div>
    </div>
@stop