<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- role_id Form Input -->
    <div class="form-group">
        {!! Form::label('role_id', 'Site Role') !!}
        {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'placeholder' => 'Select a role']) !!}
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

    <toggled-field hidden="{{ isset($user) && $user->corporate }}" hide-text="Cancel" show-text="Assign Corporate">
        <!-- corporate Form Input -->
        <div class="form-group">
            {!! Form::label('corporate_id', 'Corporate') !!}
            {!! Form::select('corporate_id', $corporates->toArray(), null, ['class' => 'form-control']) !!}
        </div>

        <!-- corporate_role_id Form Input -->
        <div class="form-group">
            {!! Form::label('corporate_role_id', 'Corporate Role') !!}
            {!! Form::select('corporate_role_id', $corporateRoles->toArray(), null, ['class' => 'form-control']) !!}
        </div>
    </toggled-field>
</div>

<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
