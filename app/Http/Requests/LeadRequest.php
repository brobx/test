<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class LeadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && ! $this->user()->hasApplied($this->route('listings'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $phoneRequired = auth()->check() && ! auth()->user()->phone && $this->get('type') === 'callback';

        return [
            'type' => 'in:branch,online,callback',
            'phone' => ($phoneRequired ? 'required|' : '') .  "digits_between:10,15"
        ];
    }
}
