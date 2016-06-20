<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Product Name (English)') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'dir' => 'auto']) !!}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <!-- name Form Input -->
    <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
        {!! Form::label('name_ar', 'Product Name (Arabic)') !!}
        {!! Form::text('name_ar', isset($listing) ? $listing->translate('ar')->name : null, ['class' => 'form-control', 'dir' => 'auto']) !!}

        @if ($errors->has('name_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('name_ar') }}</strong>
            </span>
        @endif
    </div>

    <!-- url Form Input -->
    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
        {!! Form::label('url', 'Product URL') !!}
        {!! Form::text('url', null, ['class' => 'form-control']) !!}

        @if ($errors->has('url'))
            <span class="help-block">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
        @endif
    </div>

    <div>
        <h3>Product Parameters</h3>
        <div>
            {!! FieldHelper::renderErrors($errors) !!}
            @foreach($fields as $field)
                {!! FieldHelper::render($field, getFieldFormValue($field)) !!}
            @endforeach
        </div>
    </div>

    <div>
        <h3>Product Details</h3>
        @include('corporate.listings._productDetails')
    </div>

    <inline-slider-upload message="* Dimensions: 152px × 152px" name="image" url="{{ route('backend.corporate.images.slider') }}"></inline-slider-upload>
</div>

<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
