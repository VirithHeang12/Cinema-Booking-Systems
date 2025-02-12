<?php

namespace App\Http\Requests\Classifications;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:classifications,name',
            'description' => 'required|string',
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
            'name.required' => 'The classification name is required.',
            'name.string' => 'The classification name must be a valid string.',
            'name.max' => 'The classification name cannot exceed 50 characters.',
            'name.unique' => 'This classification name is already taken. Please choose a different one.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a valid string.'
        ];
    }
}
