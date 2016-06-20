<a class="btn btn-danger {{@$class ?: 'btn-xs'}}" href="#" data-toggle="modal" data-target="#delete-{{ $id }}">
    <i class="fa fa-trash"></i>
    Delete
</a>
<div class="modal modal-danger fade" id="delete-{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ $body }}</p>
                {!! Form::open(['method' => 'DELETE', 'url' => $route]) !!}
                @if(isset($hasDescription))
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}

                        @if ($errors->has('description'))
                            <span class="help-block">
                					<strong>{{ $errors->first('description') }}</strong>
            					</span>
                        @endif
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-outline">Delete</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>