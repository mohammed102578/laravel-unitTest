<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization logic can be added here
    }

    public function rules()
    {
        return [
            'first_name_en' => 'required|string|max:255',
            'first_name_ar' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'phone' => 'required|max:20|min:10|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
        ];
    }

    public function messages()
    {
        return [
            'first_name_en.required' => 'The first name field is required.',
            'first_name_ar.required' => 'The first name field is required.',
            'last_name_en.required' => 'The last name field is required.',
            'last_name_ar.required' => 'The last name field is required.',
            'company_id.required' => 'The company ID field is required.',
            'phone.required' => 'The phone number field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];
    }
}
