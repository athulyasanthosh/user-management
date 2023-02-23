<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateUserRequest extends FormRequest
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
        $validation = [
            'name' => 'required|string|max:100',
            'status' => 'required|in:0,1'
        ];

        if(!$this->input('user_id')) {
            $validation['email']      = 'required|email|unique:users,email';
        } else {
            $validation['email']      = 'required|email|unique:users,email,'.$this->input('user_id');
        }

        return $validation;
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => __('other-validation.required_field'),
            'email.required'       => __('other-validation.required_field'),
            'status.required'      => __('other-validation.required_field'),            
            'name.string'          => __('other-validation.required_field'),
            'name.max'             => __('other-validation.required_field'),
            'email.email'          => __('other-validation.valid_email'),
            'email.unique'         => __('other-validation.unique_value'),
            'status.in'            => __('other-validation.invalid_value'),            
        ];
    }
}
