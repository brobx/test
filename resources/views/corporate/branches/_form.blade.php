<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('name', 'Branch Name (English)') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- name_ar Form Input -->
    <div class="form-group">
        {!! Form::label('name_ar', 'Name (Arabic)') !!}
        {!! Form::text('name_ar', isset($branch) ? $branch->translate('ar')->name : null, ['class' => 'form-control', 'dir' => "auto"]) !!}
    </div>

    <!-- longitude Form Input -->
    <div class="form-group">
        {!! Form::label('longitude', 'Longitude') !!}
        {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
    </div>

    <!-- longitude Form Input -->
    <div class="form-group">
        {!! Form::label('latitude', 'Latitude') !!}
        {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
    </div>

    <!-- address Form Input -->
    <div class="form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    </div>

    <!-- address Form Input -->
    <div class="form-group">
        {!! Form::label('address_ar', 'Address (Arabic)') !!}
        {!! Form::textarea('address_ar', isset($branch) ? $branch->translate('ar')->address : null, ['class' => 'form-control', 'dir' => "auto"]) !!}
    </div>

    <!-- working_hours Form Input -->
    <div class="form-group">
        {!! Form::label('working_hours', 'Working Hours') !!}
        {!! Form::text('working_hours', null, ['class' => 'form-control']) !!}
    </div>

    <!-- phone Form Input -->
    <div class="form-group">
        {!! Form::label('phone', 'Phone') !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
