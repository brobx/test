<label>Name</label>
<p>{{ $pending->pendingModel->name }}</p>
<label>Arabic name</label>
<p>{{ $pending->pendingModel->translate()->name }}</p>
<label>Longitude</label>
<p>{{ $pending->pendingModel->longitude }}</p>
<label>Latitude</label>
<p>{{ $pending->pendingModel->latitude }}</p>
<label>Address</label>
<p>{{ $pending->pendingModel->address }}</p>
<label>Arabic Address</label>
<p>{{ $pending->pendingModel->translate()->address }}</p>
<label>Working Hours</label>
<p>{{ $pending->pendingModel->working_hours }}</p>
<label>Phone</label>
<p>{{ $pending->pendingModel->phone }}</p>