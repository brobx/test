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
            </div>
        </div>
        <div class="modal-footer form-group center-block">
            {!! Form::submit(trans('main.apply'), ['class' => 'btn btn-trans btn-sm green'])!!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
