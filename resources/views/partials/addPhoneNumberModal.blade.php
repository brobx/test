<div class="remodal" data-remodal-id="phone-modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="row">
        <div class="modal-heading">
            <h3>@lang('main.addNumber')</h3>
            <p>@lang('main.plzAddNumber')</p>
        </div>
        {!! Form::open(['url' => route('listing.apply', $listing->id), 'id' => 'phone-application']) !!}
        {!! Form::hidden('type', 'callback') !!}
        <div class="modal-body">
            <div class="form-group col-md-6">
                <input name="phone" type="text" class="form-control" placeholder="{{ trans('main.mobilePhone') }}">
                <label for="prefferedCallTime">Preferred call time</label>
                    <select class="form-control" name="prefferedCallTime">
                        <option value="1">9 a.m. - 12 p.m</option>
                        <option value="2">12 p.m. - 3 p.m</option>
                        <option value="3">3 a.m. - 6 p.m</option>
                        <option value="4">6 a.m. - 9 p.m</option>
                    </select>
            </div>
        </div>
        <div class="modal-footer form-group center-block">
            {!! Form::submit(trans('main.apply'), ['class' => 'btn btn-trans btn-sm green'])!!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
