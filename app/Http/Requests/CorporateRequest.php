<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CorporateRequest extends Request
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
        $id = $this->method() === 'PATCH' ? $this->route('corporates')->manager->id : null;

        $rules = [
            'name'     => 'required',
            'name_ar'  => 'required',
            'type_id'  => 'required|exists:corporate_types,id'
        ];

        if($this->has('email') && $this->method() == 'POST') {
            $rules['email'] = 'required|email|unique:users,email' . ($id ? ',' . $id : '');
            $rules['password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }
}
