@extends('corporate.layouts.app')
@section('page.title', 'Listings')
@section('page.breadcrumb')
    <li>Sponsored Listings</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Filters</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['method' => 'GET', 'v-clean']) !!}
        <div class="box-body">
            <div class="col-md-6">
                <!--  Form Input -->
                <div class="form-group">
                    {!! Form::label('service', 'Service') !!}
                    {!! Form::select('service', ['' => 'All'] + $services->toArray(), Request::get('service'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <!-- status Form Input -->
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', ['' => 'All', 'active' => 'Sponsored (Active)', 'inactive' => 'Sponsored (Inactive)', 'sponsored' => 'Sponsored', 'not' => 'Not Sponsored'], Request::get('status'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
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
                    <th>Service</th>
                    <th>Status</th>
                    <th>Impressions</th>
                    <th>Target</th>
                    <th>Clicks</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listings as $listing)
                    <tr>
                        <td>{{ $listing->name }}</td>
                        <td>{{ $listing->service->name }}</td>
                        <td>{!! $listing->present()->sponsorshipStatus !!}</td>
                        <td>{{ $listing->impressions }}</td>
                        <td>{{ $listing->targeted_impressions }}</td>
                        <td>{{ $listing->clicks }}</td>
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