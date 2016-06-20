<a class="btn btn-{{ $suspended ? 'success' : 'warning' }} btn-xs" href="#" data-toggle="modal" data-target="#suspend-{{ $id }}">
    <i class="fa fa-{{ $suspended ? 'check' : 'ban' }}"></i>
    {{ $suspended ? 'Restore' : 'Suspend' }}
</a>
<div class="modal modal-default fade" id="suspend-{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ $body }}</p>
            </div>
            {!! Form::open(['method' => 'PATCH', 'url' => $route]) !!}
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">{{ $suspended ? 'Restore' : 'Suspend' }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>