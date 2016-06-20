<div>
    <!--  Form Input -->
    <div class="form-group{{ $errors->has('overview') ? ' has-error' : '' }}">
        {!! Form::label('overview', 'Overview (English)') !!}
        {!! Form::textarea('overview', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('overview'))
            <span class="help-block">
                <strong>{{ $errors->first('overview') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('overview_ar') ? ' has-error' : '' }}">
        {!! Form::label('overview_ar', 'Overview (Arabic)') !!}
        {!! Form::textarea('overview_ar', isset($listing) ? $listing->translate('ar')->overview : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('overview_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('overview_ar') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('offers') ? ' has-error' : '' }}">
        {!! Form::label('offers', 'Offers (English)') !!}
        {!! Form::textarea('offers', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('offers'))
            <span class="help-block">
                <strong>{{ $errors->first('offers') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('offers_ar') ? ' has-error' : '' }}">
        {!! Form::label('offers_ar', 'Offers (Arabic)') !!}
        {!! Form::textarea('offers_ar', isset($listing) ? $listing->translate('ar')->offers : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('offers_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('offers_ar') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
        {!! Form::label('details', 'Details (English)') !!}
        {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('details'))
            <span class="help-block">
                <strong>{{ $errors->first('details') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('details_ar') ? ' has-error' : '' }}">
        {!! Form::label('details_ar', 'Details (Arabic)') !!}
        {!! Form::textarea('details_ar', isset($listing) ? $listing->translate('ar')->details : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('details_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('details_ar') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('benefits') ? ' has-error' : '' }}">
        {!! Form::label('benefits', 'Benefits (English)') !!}
        {!! Form::textarea('benefits', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('benefits'))
            <span class="help-block">
                <strong>{{ $errors->first('benefits') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('benefits_ar') ? ' has-error' : '' }}">
        {!! Form::label('benefits_ar', 'Benefits (Arabic)') !!}
        {!! Form::textarea('benefits_ar', isset($listing) ? $listing->translate('ar')->benefits : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('benefits_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('benefits_ar') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('eligibility') ? ' has-error' : '' }}">
        {!! Form::label('eligibility', 'Eligibility (English)') !!}
        {!! Form::textarea('eligibility', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('eligibility'))
            <span class="help-block">
                <strong>{{ $errors->first('eligibility') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('eligibility_ar') ? ' has-error' : '' }}">
        {!! Form::label('eligibility_ar', 'Eligibility (Arabic)') !!}
        {!! Form::textarea('eligibility_ar', isset($listing) ? $listing->translate('ar')->eligibility : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('eligibility_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('eligibility_ar') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
        {!! Form::label('documents', 'Documents (English)') !!}
        {!! Form::textarea('documents', null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}

        @if ($errors->has('documents'))
            <span class="help-block">
                <strong>{{ $errors->first('documents') }}</strong>
            </span>
        @endif
    </div>

    <!--  Form Input -->
    <div class="form-group{{ $errors->has('documents_ar') ? ' has-error' : '' }}">
        {!! Form::label('documents_ar', 'Documents (Arabic)') !!}
        {!! Form::textarea('documents_ar', isset($listing) ? $listing->translate('ar')->documents : null, ['class' => 'form-control', 'rows' => 3, 'dir' => 'auto']) !!}


        @if ($errors->has('documents_ar'))
            <span class="help-block">
                <strong>{{ $errors->first('documents_ar') }}</strong>
            </span>
        @endif
    </div>
</div>