<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GigFormRequest extends FormRequest
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
        $hasGigId = $this->route('id') ? true : false;

        return $hasGigId ? [
            'company' => 'filled',
            'role' => 'filled',
            'address' => 'filled',
            'region' => 'filled',
            'tags' => 'filled',
            'min_salary' => 'filled',
            'max_salary' => 'filled'
        ] : [
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
        $hasGigId = $this->route('id') ? true : false;

        return $hasGigId ? [
            'company' => 'company',
            'role' => 'role',
            'address' => 'address',
            'region' => 'region',
            'tags' => 'tags',
            'min_salary' => 'min_salary',
            'max_salary' => 'max_salary'
        ] : [
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
            'company.filled' => ':attribute cannot be empty',
            'role.required' => ':attribute is not valid',
            'role.filled' => ':attribute cannot be empty',
            'address.required' => ':attribute is not valid',
            'address.filled' => ':attribute cannot be empty',
            'region.required' => ':attribute is not valid',
            'region.filled' => ':attribute cannot be empty',
            'tags.required' => ':attribute is not valid',
            'tags.filled' => ':attribute cannot be empty',
            'min_salary.required' => ':attribute is not valid',
            'min_salary.filled' => ':attribute cannot be empty',
            'max_salary.required' => ':attribute is not valid',
            'max_salary.filled' => ':attribute cannot be empty'
        ];
    }
}
