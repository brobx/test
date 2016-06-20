{!! Form::open(['method' => 'GET', 'url' => Request::url(), 'v-clean']) !!}
<ul>
    @foreach($fields as $field)
        <li>
            {!! FilterField::render($field, Request::get(FilterField::getInputName($field), '')) !!}
        </li>
    @endforeach
    <li>
        <button type="submit" class="btn btn-trans btn-block" id="btn-search">{{ trans('main.search') }}</button>
    </li>
</ul>
{!! Form::close() !!}