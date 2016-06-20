@extends('corporate.layouts.app')
@section('page.title', 'Client Leads')
@section('page.breadcrumb')
    <li class="active">Leads</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Filter Leads</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['method' => 'GET', 'v-clean']) !!}
        <div class="box-body">
            <div class="col-md-4">
                <!-- Listing Form Input -->
                <div class="form-group">
                    {!! Form::label('listing', 'Listing') !!}
                    {!! Form::select('listing', ['' => 'All'] + $listings, Request::get('listing'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- Type Form Input -->
                <div class="form-group">
                    {!! Form::label('type', 'Type') !!}
                    {!! Form::select('type', ['' => 'All', 'callback' => 'Call Back Request', 'online' => 'Apply Online', 'branch' => 'Find Branch'], Request::get('type'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- Language Form Input -->
                <div class="form-group">
                    {!! Form::label('language', 'Language') !!}
                    {!! Form::select('language', ['' => 'All', 'en' => 'English', 'ar' => 'Arabic'], Request::get('language'), ['class' => 'form-control']) !!}
                </div>
            </div>
            @if($leads->count())
                <div class="col-md-6">
                    <!-- from Form Input -->
                    <div class="form-group">
                        {!! Form::label('from', 'From:') !!}
                        {!! Form::text('from', Request::get('from', $leads->min('created_at')->format('d-m-Y')), ['class' => 'form-control', 'v-date-picker']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- to Form Input -->
                    <div class="form-group">
                        {!! Form::label('to', 'To:') !!}
                        {!! Form::text('to', Request::get('to', $leads->max('created_at')->format('d-m-Y')), ['class' => 'form-control', 'v-date-picker']) !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="box-footer">
            {!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Leads</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Listing Name</th>
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Applied At</th>
                    <th>Type</th>
                    <th>IP Address</th>
                    <th>Language</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->listing->name }}</td>
                        <td>{{ $lead->user->name }}</td>
                        <td>{{ $lead->user->email }}</td>
                        <td>{{ $lead->user->phone }}</td>
                        <td>{{ $lead->created_at }}</td>
                        <td>{!! $lead->present()->type !!}</td>
                        <td>{{ $lead->ip_address }}</td>
                        <td>{{ $lead->language }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $leads->render() !!}
            </div>
        </div>
    </div>
@stop