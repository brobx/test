<section class="invoice">

    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Qarenhom.com
                <small class="pull-right">
                    Date From: {{ $invoice->present()->fromDate }} To {{ $invoice->present()->dueDate }}</small>
            </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <b>Invoice #{{ $invoice->id }}</b><br>
            <br>
            <b>Payment Due:</b> {{ $invoice->present()->dueDate }}<br>
            <b>Account:</b> {{ $currentCorporate->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Qty</th>
                    <th>Listing</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        @if($currentCorporate->type_id == 1)
                            <td>{{ number_format($item->count) }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->count * $currentCorporate->lead_price) }} EGP</td>
                        @elseif($currentCorporate->type_id == 2)
                            <td>{{ number_format($item->count) }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->count * $currentCorporate->lead_price) }} EGP</td>
                        @elseif($currentCorporate->type_id == 3)
                            <td>1</td>
                            <td>{{ $item->listing->name }}</td>
                            <td>{{ number_format($item->amount * $invoice->getCommission($item->listing->service) / 100) }} EGP</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Amount Due {{ $invoice->present()->dueDate }}</p>

            <div class="table-responsive">
                @if($currentCorporate->type_id != 3)
                <table class="table">
                    @if($currentCorporate->type_id == 1)
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{ $invoice->amount + $invoice->discount }} EGP</td>
                        </tr>
                         <tr>
                            <th>Discount:</th>
                            <td>- {{ $invoice->discount }} EGP</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Total:</th>
                        <td>{{ $invoice->amount }} EGP</td>
                    </tr>
                </table>
                @else
                    <table class="table">
                        <tr>
                            <th>Total:</th>
                            <td>{{ $invoice->amount }} EGP</td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-xs-12">
            <a href="{{ route('backend.corporate.invoices.print', $invoice->id) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <!--
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
            -->
        </div>
    </div>
</section>
