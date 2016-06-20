<a class="btn bg-purple btn-xs" href="#" data-toggle="modal" data-target="#commission-{{ $agency->id }}-{{ $service->id }}">
    <i class="fa fa-dollar"></i>
    Update Commission
</a>
<div class="modal modal-default fade" id="commission-{{ $agency->id }}-{{ $service->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update {{ $agency->name }} commission</h4>
            </div>
            {!! Form::open(['url' => $route, 'method' => 'PATCH']) !!}
            <div class="modal-body">
                <!-- targeted_impressions Form Input -->
                <div class="form-group">
                    {!! Form::label('commission', 'Commission') !!}
                    {!! Form::text('commission', $service->pivot->commission, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>