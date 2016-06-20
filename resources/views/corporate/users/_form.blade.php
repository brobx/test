<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>


    <!-- corporate_role_id Form Input -->
    <div class="form-group">
        {!! Form::label('corporate_role_id', 'Corporate Role') !!}
        {!! Form::select('corporate_role_id', ['' => 'Select Role'] + $corporateRoles->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div>
        @if(isset($user))
            <toggled-field hide-text="Cancel" show-text="Change Email/Password">
                @endif
                        <!-- email Form Input -->
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <!-- password Form Input -->
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'value' => '']) !!}
                </div>

                <!-- password_confirmation Form Input -->
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm password') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'value' => '']) !!}
                </div>

                @if(isset($user))
            </toggled-field>
        @endif
    </div>

</div>

<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
