<label>Website</label>
<p>{{ $modifications['website'] or '---' }}</p>
<label>Email</label>
<p>{{ $modifications['email'] or '---' }}</p>
<label>Phone</label>
<p>{{ $modifications['phone'] or '---' }}</p>
<label>Description</label>
<p>{{ $modifications['description'] or '---' }}</p>
<label>Arabic Description</label>
<p>{{ $modifications['description_ar'] or '---' }}</p>
<label>Logo</label>
<p>@if(key_exists('logo', $modifications))<img src="{{ imagePath($modifications['logo']) }}" style="max-width=100%;">@endif</p>