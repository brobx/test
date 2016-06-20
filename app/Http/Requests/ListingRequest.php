<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ListingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->addHttpToInput('url');

        $rules = [
            'name' => 'required|min:3',
            'url' => 'active_url',
            'overview' => 'required|min:10',
            'overview_ar' => 'required|min:10',
            'offers' => 'required|min:10',
            'offers_ar' => 'required|min:10',
            'details' => 'required|min:10',
            'details_ar' => 'required|min:10',
            'documents' => 'required|min:10',
            'documents_ar' => 'required|min:10'
        ];

        $this->service = $this->route('services');
        $this->service->load('listingFields');

        if($this->service->corporateType->slug != 'travel') {
            $rules += [
                'benefits' => 'required|min:10',
                'benefits_ar' => 'required|min:10',
                'eligibility' => 'required|min:10',
                'eligibility_ar' => 'required|min:10'
            ];
        }

        foreach ($this->get('fields') as $id => $value) {
            $field = $this->service->listingFields->where('id', $id)->first();
            $rules['fields.' . $id] = array_has($field->settings, 'validation') && $field->settings['validation'] ? $field->settings['validation'] : 'required';
            if ($field->name == 'Return Date') {
                $departure = 'fields.' . $this->service->listingFields->where('name', 'Departure Date')->first()->id;
                $rules['fields.' . $id] .= '|after:' . $departure;
            }
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        $attributes = [];

        foreach ($this->get('fields') as $id => $value) {
            $field = $this->service->listingFields->where('id', $id)->first();
            $attributes['fields.' . $id] = $field->name;
        }

        return $attributes;
    }
}
