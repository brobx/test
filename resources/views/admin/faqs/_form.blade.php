<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('question', 'Question (English)') !!}
        {!! Form::text('question', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('question_ar', 'Question (Arabic)') !!}
        {!! Form::text('question_ar', isset($faq) ? $faq->translate('ar')->question : null, ['class' => 'form-control', 'dir' => 'auto']) !!}
    </div>

    <!-- category_id Form Input -->
    <div class="form-group">
        {!! Form::label('category_id', 'Category') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    </div>

    <!--  Form Input -->
    <div class="form-group">
        {!! Form::label('answer', 'Answer (English)') !!}
        {!! Form::textarea('answer', null, ['class' => 'form-control', 'v-tinymce']) !!}
    </div>

    <!--  Form Input -->
    <div class="form-group">
        {!! Form::label('answer_ar', 'Answer (Arabic)') !!}
        {!! Form::textarea('answer_ar', isset($faq) ? $faq->translate('ar')->answer : null, ['class' => 'form-control', 'v-tinymce', 'dir' => 'auto']) !!}
    </div>
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success', 'v-disable-after-submit']) !!}
</div>
