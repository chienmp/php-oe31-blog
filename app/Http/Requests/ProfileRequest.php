<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|alpha',
            'email' => 'required|unique:users|email',
            'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('required'),
            'name.alpha' => trans('alpha'),
            'email.required' => trans('required'),
            'email.email' => trans('email'),
            'email.unique' => trans('unique'),
            'image.required' => trans('required'),
            'image.image' => trans('image'),
        ];
    }
}
