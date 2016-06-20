<?php

namespace App\Policies;

use App\Corporate;
use App\Invoice;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Invoice $invoice
     * @return bool
     */
    public function show(User $user, Invoice $invoice)
    {
        return $user->corporate_id === $invoice->billable_id && $invoice->billable_type === Corporate::class;
    }
}
