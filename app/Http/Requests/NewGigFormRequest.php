<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewGigFormRequest extends FormRequest
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
            "user" => "required|exists:users,id",
            'company' => 'required',
            'role' => 'required',
            'address' => 'required',
            'region' => 'required',
            'tags' => 'required',
            'min_salary' => 'required',
            'max_salary' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user' => 'user',
            'company' => 'company',
            'role' => 'role',
            'address' => 'address',
            'region' => 'region',
            'tags' => 'tags',
            'min_salary' => 'min_salary',
            'max_salary' => 'max_salary'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user' => ':attribute does not exists',
            'company.required' => ':attribute is not valid',
            'role.required' => ':attribute is not valid',
            'address.required' => ':attribute is not valid',
            'region.required' => ':attribute is not valid',
            'tags.required' => ':attribute is not valid',
            'min_salary.required' => ':attribute is not valid',
            'max_salary.required' => ':attribute is not valid'
        ];
    }
}
