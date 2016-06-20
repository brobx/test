@extends('admin.layouts.app')
@section('page.title', 'Corporates')
@section('page.description')
    <a href="{{ route('backend.admin.corporates.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">Corporates</li>
@stop

@section('content')
    <!-- Filter Form -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Filter</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        {!! Form::open(['method' => 'GET', 'v-clean']) !!}
        <div class="box-body">
            <!-- type_id Form Input -->
            <div class="form-group">
                {!! Form::label('type', 'By Type') !!}
                {!! Form::select('type', ['' => 'All'] + $types->toArray(), Request::get('type'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Filter', ['class' => 'btn btn-success']) !!}
            <a href="{{ route('backend.admin.corporates.index') }}" class="btn btn-danger">Remove Filters</a>
        </div>
        {!! Form::close() !!}
    </div>
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Corporates</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Name Arabic</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($corporates as $corporate)
                    <tr>
                        <td>{{ $corporate->id }}</td>
                        <td>{{ $corporate->name }}</td>
                        <td>{{ $corporate->translate('ar')->name }}</td>
                        <td>{{ $corporate->type->title }}</td>
                        <td>
                            <a href="{{ route('backend.admin.corporates.edit', $corporate->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $corporate->id,
                                'title' => $corporate->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.corporates.destroy', $corporate->id)
                             ])
                            @include('admin.modals.suspend', [
                                'suspended' => $corporate->suspended,
                                'id' => $corporate->id,
                                'title' => "Suspend " . $corporate->name,
                                'body' => $corporate->suspended ? 'This will allow the corporate users to log in and makes the corporate listing visible' : 'This will remove its listing from the site and prevent its users from logging in.',
                                'route' => route('backend.admin.corporates.suspend', $corporate->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $corporates->render() !!}
            </div>
        </div>
    </div>

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){
    z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?3gNJnv6aszkivnOvIXtpvOXJIPEJ9mxE';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script>
    <!--End of Zopim Live Chat Script-->
@stop