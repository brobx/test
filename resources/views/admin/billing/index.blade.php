@extends('admin.layouts.app')
@section('page.title', 'Billing Settings')
@section('page.description')
    Manage How billing is done.
@stop
@section('page.breadcrumb')
    <li class="active">Billing</li>
@stop

@section('content')
    <div class="row">
        <div class="container">
            <div class="col-md-12 box">
                <div class="box-header">
                    <h3 class="box-title">Banking Billings</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Bank</th>
                            <th>Discount (Monthly Leads)</th>
                            <th>Per Lead (EGP)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banks as $bank)
                            <tr>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->discount }}</td>
                                <td>{{ $bank->lead_price }}</td>
                                <td>
                                    @include('admin.billing._discount', [
                                        'listing' => $bank,
                                        'route' => route('backend.admin.corporates.discount', $bank->id)
                                    ])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <div class="col-md-12 box">
                <div class="box-header">
                    <h3 class="box-title">Travel Agencies Commissions</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Agency</th>
                            <th>Service</th>
                            <th>Commission</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agencies as $agency)
                            @foreach($agency->servicesWithCommission as $service)
                                <tr>
                                    <td>{{ $agency->name }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->pivot->commission }}%</td>
                                    <td>
                                        @include('admin.billing._commission', [
                                            'route' => route('backend.admin.corporates.services.commission', [$agency->id, $service->id]),
                                            'agency' => $agency,
                                            'service' => $service
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
