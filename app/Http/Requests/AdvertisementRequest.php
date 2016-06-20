<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdvertisementRequest extends Request
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
        $rules = [
            'title' => 'required|min:3',
            'url' => 'required|url',
            'corporate_id' => 'required|exists:corporates,id',
            'price' => 'numeric'
        ];

        // is creating.
        if($this->method() == 'POST') {
            $rules['image'] = 'required';
            return $rules;
        }

        return $rules;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->addHttpToInput();
    }
}
