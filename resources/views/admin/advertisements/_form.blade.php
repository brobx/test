<div class="box-body">
    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <!-- name Form Input -->
    <div class="form-group">
        {!! Form::label('url', 'Url') !!}
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('target_impressions', 'Targeted Impressions') !!}
        {!! Form::text('target_impressions', null, ['class' => 'form-control']) !!}
    </div>

    <!-- price Form Input -->
    <div class="form-group">
        {!! Form::label('price', 'Price') !!}
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Image (English)') !!}
        <image-upload name="image" url="{{ route('backend.admin.images.add') }}" file-name="{{ old('image') ? old('image') : (isset($ad) ? $ad->image : '') }}"></image-upload>
    </div>

    <div class="form-group">
        {!! Form::label('image_ar', 'Image (Arabic)') !!}
        <image-upload name="image_ar" url="{{ route('backend.admin.images.add') }}" file-name="{{ old('image_ar') ? old('image_ar') : (isset($ad) ? $ad->translate('ar')->image : '') }}"></image-upload>
    </div>

    <!-- corporate_id Form Input -->
    <div class="form-group">
        {!! Form::label('corporate_id', 'Corporate') !!}
        {!! Form::select('corporate_id', $corporates->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Checked</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="2"><b>General Pages</b></td></tr>
                @foreach($spots as $spot)
                    @if($spot->service_bound == 0)
                    <tr>
                        <td>{{ $spot->page }}</td>
                        <td>{!! Form::checkbox("spots[{$spot->id}]", null, isset($ad) ? $ad->advertisedOn($spot->id) : false) !!}</td>
                    </tr>
                    @endif
                @endforeach
                @foreach($services as $service)
                    <tr><td colspan="2"><b>{{ ucwords($service->name) }}</b></td></tr>
                    @foreach($spots as $spot)
                        @if($spot->service_bound == 1)
                        <tr>
                            <td>{{ $spot->page }}</td>
                            <td>{!! Form::checkbox("spots[{$spot->id}][{$service->id}]", null, isset($ad) ? $ad->advertisedOn($spot->id, $service->id) : false) !!}</td>
                        </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="box-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
