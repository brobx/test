<label>Image</label>
<p><img src="{{ imagePath($pending->pendingModel->image) }}" style="max-height:100%;"></p>
<label>Description</label>
<p>{{ $pending->pendingModel->description }}</p>
<label>Arabic Description</label>
<p>{{ $pending->pendingModel->translate('ar')->description }}</p>
