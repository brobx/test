<label>Image</label>
<p>@if(key_exists('image', $modifications))<img src="{{ strpos($modifications['image'], 'uploads/') ? $modifications['image'] : imagePath($modifications['image']) }}" style="max-width:100%;">@endif</p>
<label>Description</label>
<p>{{ $modifications['description'] or '---' }}</p>
<label>Arabic Description</label>
<p>{{ $modifications['description_ar'] or '---' }}</p>