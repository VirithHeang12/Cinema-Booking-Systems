<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'. User::class],
            'phone_number'      => ['required', 'string', 'max:255'],
            'password'          => ['required', 'confirmed', Password::defaults()]
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
            'name.required'         => 'Name is required',
            'email.required'        => 'Email is required',
            'email.email'           => 'Email must be a valid email address',
            'email.unique'          => 'Email is already taken',
            'phone_number.required' => 'Phone number is required',
            'password.required'     => 'Password is required',
            'password.confirmed'    => 'Passwords do not match'
        ];
    }
}
