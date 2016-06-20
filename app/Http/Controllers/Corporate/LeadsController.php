<?php

namespace App\Http\Controllers\Corporate;

use App\Filters\Admin\LeadFilter;
use App\Http\Requests;

class LeadsController extends CorporateController
{
    /**
     * @param LeadFilter $filters
     * @return mixed
     */
    public function index(LeadFilter $filters)
    {
        $leads = $this->corporate->leads()
                                 ->with('user', 'listing')
                                 ->filter($filters)
                                 ->latest()
                                 ->paginate(20);

        $listings = $this->corporate->listings()->lists('name', 'id')->toArray();

        return view('corporate.leads.index', compact('leads', 'listings'));
    }
}
