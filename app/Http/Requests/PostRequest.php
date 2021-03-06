<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request
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
        $required = $this->method() == 'POST' ? 'required|' : '';

        return [
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:10',
            'title_ar' => 'required|min:3|max:255',
            'body_ar' => 'required|min:10',
            'image' => "{$required}"
        ];
    }
}
