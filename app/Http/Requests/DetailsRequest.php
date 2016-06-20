<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DetailsRequest extends Request
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
        return [
            'website' => 'required|active_url',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'description' => 'required',
            'description_ar' => 'required'
        ];
    }

    public function all()
    {
        return $this->addHttpToInput('website');
    }
}
