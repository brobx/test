<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#discount-{{ $bank->id }}">
    <i class="fa fa-dollar"></i>
    Update
</a>
<div class="modal modal-default fade" id="discount-{{ $bank->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update {{ $bank->name }} discount</h4>
            </div>
            {!! Form::model($bank, ['url' => $route, 'method' => 'PATCH']) !!}
            <div class="modal-body">
                <!-- discount Form Input -->
                <div class="form-group">
                    {!! Form::label('discount', 'Discount') !!}
                    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('lead_price', 'Price Per Lead') !!}
                    {!! Form::text('lead_price', null, ['class' => 'form-control']) !!}
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
