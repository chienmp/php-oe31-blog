<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('required'),
            'title.unique' => trans('unique'),
            'body.required' => trans('required'),
            'image.required' => trans('required'),
            'image.image' => trans('image'),
        ];
    }
}
