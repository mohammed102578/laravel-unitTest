<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,'.$this->route('company'),
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'logo' => 'image|dimensions:min_width=100,min_height=100|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'required|string|max:255|url',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'The name_ar field is required.',
            'name_en.required' => 'The name_en field is required.',
            'email.required' => 'The email field is required.',
            'logo.required' => 'The logo field is required.',
            'website.required' => 'The website field is required.',
            // Add more custom messages as needed...
        ];
    }
}
