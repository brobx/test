@extends('master')
@section('page.title', trans('main.rate') . " {$listing->translate()->name}")

@section('content')
    {!! Form::open(['url' => route('listing.postRate', $listing->id)]) !!}
    <div class="text-center">
        @foreach($ratingParameters as $index => $parameter)
            <div class="form-group">
                <label for="parameters-{{ $index }}">{{ $parameter }}</label>
                <input data-size='xs' type="number" min="1" max="5" step="1" id="parameters-{{ $index }}" v-star name="{{$parameter}}" required>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-trans">Submit</button>
    </div>
    {!! Form::close() !!}
@stop