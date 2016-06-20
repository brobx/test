<?php

namespace App\Http\Requests;

class FaqRequest extends Request
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
            'question' => 'required|min:3',
            'question_ar' => 'required|min:3',
            'category_id' => 'required|exists:f_a_q_categories,id',
            'answer' => 'required|min:10',
            'answer_ar' => 'required|min:10'
        ];
    }
}
