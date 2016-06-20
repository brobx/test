@extends('corporate.layouts.app')
@section('page.title', 'Data Requests')
@section('page.description')
    Review Data Request By the Data Entry Users
@stop
@section('page.breadcrumb')
    <li><a href="{{ route('backend.corporate.data.requests.index') }}">Data Requests</a></li>
    <li class="active">Show Request</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Show Request</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    @if(in_array($pending->type, ['update', 'delete']))
                        <li role="presentation" class="active">
                            <a href="#old" aria-controls="old" role="tab" data-toggle="tab" aria-expanded="true">Current Data</a>
                        </li>
                    @endif

                    @if(in_array($pending->type, ['update', 'create']))
                        <li role="presentation" class="{{ $pending->type == 'create' ? 'active' : '' }}">
                            <a href="#new" aria-controls="new" role="tab" data-toggle="tab" aria-expanded="false">Modifications</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content">
                    @if(in_array($pending->type, ['update', 'delete']))
                        <div role="tabpanel" class="tab-pane active" id="old">
                            @if($pending->pending_type == 'App\CorporateBranch')
                                @include('corporate.partials._oldBranch')
                            @elseif($pending->pending_type == 'App\CorporateSlider')
                                @include('corporate.partials._oldSlider')
                            @elseif($pending->pending_type == 'App\CorporateDetails')
                                @include('corporate.partials._oldDetails')
                            @elseif($pending->pending_type == 'App\Listing')
                                @include('corporate.partials._oldListing')
                            @endif
                            @if($pending->type == 'delete')
                                {!! Form::open(['url' => route('backend.corporate.data.requests.approve', $pending->id)]) !!}
                                <button type="submit" class="btn btn-success btn-xs">
                                    <i class="fa fa-check"></i> Approve
                                </button>
                                {!! Form::close() !!}
                                @include('admin.modals.delete', [
                                    'id' => $pending->id,
                                    'title' => 'Reject request',
                                    'body' => 'This Cannot be undone',
                                    'hasDescription' => true,
                                    'route' => route('backend.corporate.data.requests.deny', $pending->id)
                                ])
                            @endif
                        </div>
                    @endif

                    @if(in_array($pending->type, ['update', 'create']))
                        <div role="tabpanel" class="tab-pane {{ $pending->type == 'create' ? 'active' : '' }}" id="new">
                            <!-- Branch Request table -->
                            @if($pending->pending_type == 'App\CorporateBranch')
                                @include('corporate.partials._newBranch')
                            @elseif($pending->pending_type == 'App\CorporateDetails')
                                @include('corporate.partials._newDetails')
                            @elseif($pending->pending_type == 'App\CorporateSlider')
                                @include('corporate.partials._newSlider')
                            @elseif($pending->pending_type == 'App\Listing')
                                @include('corporate.partials._newListing')
                            @endif
                            @if($pending->type != 'delete')
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::open(['url' => route('backend.corporate.data.requests.approve', $pending->id)]) !!}
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-6">
                                    @include('admin.modals.delete', [
                                        'id' => $pending->id,
                                        'title' => 'Reject request',
                                        'body' => 'This Cannot be undone',
                                        'hasDescription' => true,
                                        'route' => route('backend.corporate.data.requests.deny', $pending->id),
                                        'class' => 'btn-lg btn-block',
                                    ])
                                </div>
                            </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop