<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#feature-{{ $id }}">
    <i class="fa fa-star"></i>
    Sponsor
</a>
<div class="modal modal-default fade" id="feature-{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Sponsor {{ $title }}</h4>
            </div>
            {!! Form::open(['url' => $route]) !!}
            <div class="modal-body">
                <p>This action will sponsor this listing in the listings page.</p>
                <!-- targeted_impressions Form Input -->
                <div class="form-group">
                    {!! Form::label('targeted_impressions', 'Targeted Impressions') !!}
                    {!! Form::text('targeted_impressions', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Sponsor</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>