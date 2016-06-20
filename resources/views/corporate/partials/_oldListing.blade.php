<div>
    <label>Name</label>
    <p>{{ $pending->pendingModel->name }}</p>
    <label>Overview</label>
    <p>{{ $pending->pendingModel->overview }}</p>
    <label>Offers</label>
    <p>{{ $pending->pendingModel->offers }}</p>
    <label>Details</label>
    <p>{{ $pending->pendingModel->details }}</p>
    <label>Benefits</label>
    <p>{{ $pending->pendingModel->benefits }}</p>
    <label>Eligibility</label>
    <p>{{ $pending->pendingModel->eligibility }}</p>
    <label>Documents</label>
    <p>{{ $pending->pendingModel->documents }}</p>
    <label>URL</label>
    <p>{{ $pending->pendingModel->url }}</p>
</div>
<div>
    <hr>
    <h4>Arabic translations</h4>
    <hr>
    <label>Name</label>
    <p>{{ $pending->pendingModel->translate()->name }}</p>
    <label>Overview</label>
    <p>{{ $pending->pendingModel->translate()->overview }}</p>
    <label>Offers</label>
    <p>{{ $pending->pendingModel->translate()->offers }}</p>
    <label>Details</label>
    <p>{{ $pending->pendingModel->translate()->details }}</p>
    <label>Benefits</label>
    <p>{{ $pending->pendingModel->translate()->benefits }}</p>
    <label>Eligibility</label>
    <p>{{ $pending->pendingModel->translate()->eligibility }}</p>
    <label>Documents</label>
    <p>{{ $pending->pendingModel->translate()->documents }}</p>
</div>
@if(count($modifications['photos']))
<div>
    <hr>
    <h4>Sliders</h4>
    <hr>
    <table class="table table-responsive">
        <tr>
            <th>Image</th>
            <th>Description</th>
            <th>Arabic description</th>
        </tr>
        @foreach($pending->pendingModel->photos as $photo)
        <tr>
            <td><img height="200" width="200" src="{{ imagePath($photo['image']) }}"></td>
            <td>{{ $photo['description'] }}</td>
            <td>{{ $photo['description_ar'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endif
<div>
    <hr>
    <h4>Fields</h4>
    <hr>
    @foreach($pending->pendingModel->fields as $field)
    <label>{{ $field->name }}</label>
    <p>{{ $field->value }}</p>
    @endforeach
</div>