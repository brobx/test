@extends('master')
@section('page.title')
    @lang('main.changePassword')
@stop

@section('content')

    @include('components/breadcrumb', [
        'title' => trans('main.myAccount'),
        'levels' => [
            ['title' => trans('main.myAccount'), 'url' => route('account.index')],
            ['title' => trans('main.changePassword'), 'url' => route('account.changePassword')]
        ]
    ])

    <section class="account">
        @include('errors.alerts')
        <div class="container">
            <div class="row account-boxes-wrapper">
                <div class="col-md-6 center-block">
                    {!! Form::open(['method' => 'PATCH', 'url' => route('account.password.update')]) !!}
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('current_password', trans('main.currentPassword')) !!}
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('password', trans('main.password')) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('password_confirmation', trans('main.confirmPassword')) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <hr>
                    {!! Form::submit(trans('main.update'), ['class' => 'btn-trans btn-trans-alt']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

@endsection
