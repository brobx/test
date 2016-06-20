<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#unfeature-{{ $id }}">
    <i class="fa fa-star-o"></i>
    Remove Sponsorship
</a>
<div class="modal modal-default fade" id="unfeature-{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Remove Sponsorship {{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>'this action will remove this listing from sponsored list.'</p>
            </div>
            {!! Form::open(['url' => $route]) !!}
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Remove Sponsorship</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>