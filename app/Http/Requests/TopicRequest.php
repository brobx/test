<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TopicRequest extends Request
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
        $priorityList = $this->route('services')->topics()->lists('priority')->toArray();
        $priorityList = implode(',', $priorityList);
        return [
            'title' => 'required|min:3',
            'body' => 'required|min:5',
            'title_ar' => 'required|min:3',
            'body_ar' => 'required|min:5',
            'priority' => 'required|not_in:' . $priorityList
        ];
    }
}
