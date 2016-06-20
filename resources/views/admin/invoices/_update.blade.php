<a class="btn bg-purple btn-xs" href="#" data-toggle="modal" data-target="#invoice-{{ $invoice->id }}">
    <i class="fa fa-dollar"></i>
    Update Payment Status
</a>
<div class="modal modal-default fade" id="invoice-{{ $invoice->id }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Set Payment status to paid?</h4>
            </div>
            {!! Form::open(['method' => 'PATCH', 'url' => route('backend.admin.invoices.update', $invoice->id)]) !!}
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>