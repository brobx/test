<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title_ar', 'Title (Ar)') !!}
        {!! Form::text('title_ar', isset($post) ? $post->translate('ar')->title : null, ['class' => 'form-control', 'dir' => "auto"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Featured Image') !!}
        <image-upload name="image" url="{{ route('backend.admin.images.add') }}" file-name="{{ old('image') ? old('image') : isset($post) ? $post->image : '' }}"></image-upload>
    </div>

    <!--  Form Input -->
    <div class="form-group">
        {!! Form::label('body', 'Content') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control', 'v-tinymce']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body_ar', 'Content (Ar)') !!}
        {!! Form::textarea('body_ar', isset($post) ? $post->translate('ar')->body : null, ['class' => 'form-control', 'v-tinymce', 'dir' => "auto"]) !!}
    </div>
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success', 'v-disable-after-submit']) !!}
</div>
