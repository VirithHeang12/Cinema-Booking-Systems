<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['required_without:email', 'nullable', 'string', 'regex:/^\+[1-9]\d{1,14}$/', 'prohibited_unless:email,null'],
            'email'        => ['required_without:phone_number', 'nullable', 'string', 'lowercase', 'email', 'max:255', 'prohibited_unless:phone_number,null'],
            'password'     => ['required'],
            'remember'     => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone_number.required_without'     => 'Phone number is required when email is not provided',
            'phone_number.prohibited_unless'    => 'Phone number is not allowed when email is provided',
            'phone_number.string'               => 'Phone number must be a string',
            'phone_number.regex'                => 'Phone number must be a valid international phone number',
            'email.required_without'            => 'Email is required when phone number is not provided',
            'email.prohibited_unless'           => 'Email is not allowed when phone number is provided',
            'email.string'                      => 'Email must be a string',
            'email.email'                       => 'Email must be a valid email address',
            'email.max'                         => 'Email must not exceed 255 characters',
            'email.lowercase'                   => 'Email must be in lowercase',
            'password.required'                 => 'Password is required',
            'password.string'                   => 'Password must be a string',
            'password.min'                      => 'Password must be at least 8 characters',
        ];
    }
}
