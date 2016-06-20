<a class="btn bg-purple btn-xs" href="#" data-toggle="modal" data-target="#video-{{ $service->id }}">
    <i class="fa fa-play"></i>
    Video Url
</a>
<div class="modal modal-default fade" id="video-{{ $service->id }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ $service->name }} Video Url</h4>
            </div>
            {!! Form::open(['method' => 'PATCH', 'url' => route('backend.admin.learn.services.video.update', $service->id)]) !!}
            <div class="modal-body">
                <!-- url Form Input -->
                <div class="form-group">
                    {!! Form::label('url', 'Url') !!}
                    {!! Form::text('url', $service->video_url, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>