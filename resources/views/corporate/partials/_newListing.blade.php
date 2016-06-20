<div>
    <label>Name</label>
    <p>{{ $modifications['data']['name'] }}</p>
    <label>Overview</label>
    <p>{{ $modifications['data']['overview'] }}</p>
    <label>Offers</label>
    <p>{{ $modifications['data']['offers'] }}</p>
    <label>Details</label>
    <p>{{ $modifications['data']['details'] }}</p>
    <label>Benefits</label>
    <p>{{ $modifications['data']['benefits'] }}</p>
    <label>Eligibility</label>
    <p>{{ $modifications['data']['eligibility'] }}</p>
    <label>Documents</label>
    <p>{{ $modifications['data']['documents'] }}</p>
    <label>URL</label>
    <p>{{ $modifications['data']['url'] }}</p>
</div>
<div>
    <hr>
    <h4>Arabic translations</h4>
    <hr>
    <label>Name</label>
    <p>{{ $translations['name'] }}</p>
    <label>Overview</label>
    <p>{{ $translations['overview'] }}</p>
    <label>Offers</label>
    <p>{{ $translations['offers'] }}</p>
    <label>Details</label>
    <p>{{ $translations['details'] }}</p>
    <label>Benefits</label>
    <p>{{ $translations['benefits'] }}</p>
    <label>Eligibility</label>
    <p>{{ $translations['eligibility'] }}</p>
    <label>Documents</label>
    <p>{{ $translations['documents'] }}</p>
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
        @foreach($modifications['photos'] as $photo)
        <tr>
            <td><img height="200" width="200" src="{{ imagePath($photo['image']) }}"></td>
            <td>{{ $photo['description']}}</td>
            <td>{{ $photo['description_ar']}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endif
<div>
    <hr>
    <h4>Fields</h4>
    <hr>
    @foreach($fields as $field)
    <label>{{ $field['name'] }}</label>
    <p>{{ $field['value'] }}</p>
    @endforeach
</div>
