<?php

namespace App\Http\Requests\Halls;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'                              => 'required|string|max:255',
            'description'                       => 'nullable|string',
            'hall_type_id'                      => 'required|exists:hall_types,id',
            'maximum_seats_per_row'             => 'required|integer|min:1',
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
            'name.required'                             => 'The hall name is required.',
            'name.string'                               => 'The hall name must be a string.',
            'name.max'                                  => 'The hall name may not be greater than 255 characters.',
            'name.unique'                               => 'The hall name has already been taken.',
            'description.string'                        => 'The hall description must be a string.',
            'hall_type_id.required'                     => 'The hall type ID is required.',
            'hall_type_id.exists'                       => 'The selected hall type ID is invalid.',
            'hall_type_id.integer'                      => 'The hall type ID must be an integer.',
            'maximum_seats_per_row.required'            => 'The maximum seats per row is required.',
            'maximum_seats_per_row.integer'             => 'The maximum seats per row must be an integer.',
            'maximum_seats_per_row.min'                 => 'The maximum seats per row must be at least 1.',
        ];
    }
}
