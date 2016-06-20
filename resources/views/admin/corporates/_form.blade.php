<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('name', 'Corporate Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('name_ar', 'Corporate Name Arabic') !!}
        {!! Form::text('name_ar', isset($corporate) ? $corporate->translate('ar')->name : null, ['class' => 'form-control', 'dir' => 'auto']) !!}
    </div>

    <!-- corporate type Form Input -->
    <div class="form-group">
        {!! Form::label('type_id', 'Corporate Type') !!}
        {!! Form::select('type_id', $types, null, ['class' => 'form-control', 'placeholder' => 'Choose a type']) !!}
    </div>

    @if(! isset($corporate))
        <!-- email Form Input -->
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', isset($corporate) ? $corporate->manager->email : null, ['class' => 'form-control']) !!}
        </div>

        <!-- password Form Input -->
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control', 'value' => '']) !!}
        </div>

        <!-- password confirmation Form Input -->
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'value' => '']) !!}
        </div>
    @endif
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>