<?php

namespace App\Http\Requests\Genres;

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
            'name'                 => 'required|string|max:50|unique:genres',
            'description'          => 'required|string|max:250',
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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 50 characters',
            'name.unique' => 'Name must be unique',
            'description.required' => 'Description is required',
            'description.string' => 'Code must be a string',
            'description.max' => 'Code must not be greater than 250 characters',
        ];
    }
}
