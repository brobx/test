@extends('corporate.layouts.app')
@section('page.title', 'Users')
@section('page.description')
    <a href="{{ route('backend.corporate.users.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">Users</li>
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
            <div class="row">
                <div class="col-md-4">
                    <!-- corporate_role Form Input -->
                    <div class="form-group">
                        {!! Form::label('corporate_role', 'Corporate Role') !!}
                        {!! Form::select('corporate_role', ['' => 'All'] + $corporateRoles->toArray(), Request::get('corporate_role'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Filter', ['class' => 'btn btn-success']) !!}
            <a href="{{ route('backend.corporate.users.index') }}" class="btn btn-danger">Remove Filters</a>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Users</h3>
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
                    <th>Corporate Role</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->corporateRole->title or '---' }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.corporate.users.edit', $user->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $user->id,
                                'title' => $user->name,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.corporate.users.destroy', $user->id)
                             ])
                            @include('admin.modals.suspend', [
                                'suspended' => $user->suspended,
                                'id' => $user->id,
                                'title' => "Suspend " . $user->name,
                                'body' => $user->suspended ? 'This will allow the user to use his/her account.' : 'This will prevent the user from using his/her account.',
                                'route' => route('backend.corporate.users.suspend', $user->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $users->render() !!}
            </div>
        </div>
    </div>
@stop