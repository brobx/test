<label>Website</label>
<p>{{ $pending->pendingModel->website or '---' }}</p>
<label>Email</label>
<p>{{ $pending->pendingModel->email or '---' }}</p>
<label>Phone</label>
<p>{{ $pending->pendingModel->phone or '---' }}</p>
<label>Description</label>
<p>{{ $pending->pendingModel->description or '---' }}</p>
<label>Arabic Description</label>
<p>{{ $pending->pendingModel->translate('ar')->description or '---' }}</p>
<label>Logo</label>
<p>@if($pending->pendingModel->logo)<img src="{{ imagePath($pending->pendingModel->logo) }}" style="max-width: 100%;">@endif</p>