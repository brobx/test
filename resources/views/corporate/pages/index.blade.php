@extends('corporate.layouts.app')
@section('page.title', 'Dashboard')
@section('page.description', 'This is the corporate admin panel')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sponsored Listings</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td><b>{{ $service->featuredCount }}</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b>{{ $services->sum('featuredCount') }}</b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Views</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td><b>{{ $service->views }}</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b>{{ $services->sum('views') }}</b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sponsored Listings</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($ads as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td><b>{{ $value }}</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b>{{ $ads->sum() }}</b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Total Leads</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <graph type="pie" url="{{ route('backend.corporate.api.stats.types') }}"></graph>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Total Leads</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <graph :tabs="{{ json_encode($tabs) }}" tab-parameter="period" type="bar" url="{{ route('backend.corporate.api.stats.leads') }}"></graph>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Services and Products</h3>
                <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                @foreach($services as $service)
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ $service->listingsCount or 0 }}</h3>
                                <p>{{ $service->name }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop