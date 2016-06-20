<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CorpUserRequest extends Request
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
        $id = $this->method() === 'PATCH' ? $this->route('users')->id : null;
        $required = $this->checkMailAndPasswordRequirement();

        return [
            'name' => 'required',
            'email' => $required . '|email|unique:users,email' . ($id ? ',' . $id : ''),
            'password' => $required . '|confirmed|min:6',
            'corporate_role_id' => 'required|exists:corporate_roles,id'
        ];
    }

    /**
     * @return bool
     */
    protected function checkMailAndPasswordRequirement()
    {
        return $this->method() === 'POST' || $this->has('email') ? 'required' : '';
    }
}
