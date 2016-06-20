<?php

namespace App\Http\Controllers\Corporate;

use App\CorporateDetails;
use App\Helpers\ImageHelper;
use App\Http\Requests;
use App\Http\Requests\DetailsRequest;
use Illuminate\Http\Request;

class DetailsController extends CorporateController
{
    /**
     * Gets the details page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetails()
    {
        $details = $this->corporate->details()->firstOrCreate([]);

        return view('corporate.pages.details', ['details' => $details, 'corporate' => $this->corporate]);
    }

    /**
     * Saves the details page.
     *
     * @param DetailsRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(DetailsRequest $request)
    {
        $input = $request->input();
        $details = $this->corporate->details;

        if ($request->user()->is_corporate('manager')) {
            $details->update($input);

            $details->updateTranslation('description', $request->get('description_ar'));

            return redirect()->route('backend.corporate.details.index')
                             ->with('success', 'Information Updated Successfully.');
        }

        $input['translations'][] = [
            'translatable_attribute' => 'description',
            'translation' => $input['description_ar']
        ];

        $details->requestUpdate($input);

        return redirect()->route('backend.corporate.details.index')
                         ->with('success', 'Information submitted successfully');
    }
}
