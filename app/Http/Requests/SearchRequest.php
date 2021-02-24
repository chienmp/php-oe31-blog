<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'query' => 'max:256|alpha_num'
        ];
    }

    public function messages()
    {
        return [
            'query.max' => trans('max');
            'query.alpha_num' => trans('alpha_num');
        ];
    }
}
