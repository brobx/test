@extends('corporate.layouts.app')
@section('page.title', 'Notifications')

@section('page.breadcrumb')
    <li class="active">Notifications</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Notifications</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td><i class="{{ $notification->icon }} text-primary"></i></td>
                        <td><a href="{{ $notification->url }}">@if($notification->unread)<b>@endif{{ $notification->body }}@if($notification->unread)</b>@endif</a></td>
                        <td>{{ $notification->created_at->diffForHumans() }}</td>
                        <td>
                            @if($notification->unread)
                                {!! Form::open(['method' => 'PATCH', 'url' => route('backend.corporate.notifications.read', $notification->id)]) !!}
                                    <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Mark as read</button>
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $notifications->render() !!}
            </div>
        </div>
    </div>

@stop