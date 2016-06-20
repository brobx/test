<ul>
    @foreach($service->getSortableFields() as $name => $text)
        <li>{!! link_to_sort($name, $text) !!}</li>
    @endforeach
</ul>