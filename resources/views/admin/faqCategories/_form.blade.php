<div class="box-body">
    <!-- title Form Input -->
    <div class="form-group">
        {!! Form::label('title', 'Title (English)') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <!-- title_ar Form Input -->
    <div class="form-group">
        {!! Form::label('title_ar', 'Title (Arabic)') !!}
        {!! Form::text('title_ar', isset($category) ? $category->translate('ar')->title : null, ['class' => 'form-control', 'dir' => 'auto']) !!}
    </div>
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
