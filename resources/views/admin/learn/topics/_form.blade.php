<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title_ar', 'Title (Ar)') !!}
        {!! Form::text('title_ar', isset($topic) ? $topic->translate('ar')->title : null, ['class' => 'form-control', 'dir' => 'auto']) !!}
    </div>

    <!--  Form Input -->
    <div class="form-group">
        {!! Form::label('body', 'Content') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control', 'v-tinymce']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body_ar', 'Content (Ar)') !!}
        {!! Form::textarea('body_ar', isset($topic) ? $topic->translate('ar')->body : null, ['class' => 'form-control', 'v-tinymce', 'dir' => 'auto']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('priority', 'Priority') !!}
        {!! Form::text('priority', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success', 'v-disable-after-submit']) !!}
</div>
