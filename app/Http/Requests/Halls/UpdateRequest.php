<?php

namespace App\Http\Requests\Halls;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name'                              => [
                'required',
                'string',
                'max:255',
                Rule::unique('halls', 'name')->ignore($this->route('hall')),
            ],
            'description'                       => 'nullable|string',
            'hall_type_id'                      => 'required|exists:hall_types,id',
            'hallSeatTypes'                     => 'required|array|min:1',
            'hallSeatTypes.*.seat_type_id'      => 'required|exists:seat_types,id',
            'hallSeatTypes.*.maximum_capacity'  => 'required|integer|min:1',
            'hallSeatTypes.*.rows'              => 'nullable',  // Allow any format (array or string)
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
            'hall_type_id.exists'                      => 'The selected hall type ID is invalid.',
            'hallSeatTypes.required'                    => 'At least one hall seat type is required.',
            'hallSeatTypes.array'                       => 'The hall seat types must be an array.',
            'hallSeatTypes.*.seat_type_id.required'     => 'The seat type ID is required for each hall seat type.',
            'hallSeatTypes.*.maximum_capacity.required' => 'The maximum capacity is required for each hall seat type.',
            'hallSeatTypes.*.maximum_capacity.integer'  => 'The maximum capacity must be an integer.',
            'hallSeatTypes.*.maximum_capacity.min'      => 'The maximum capacity must be at least 1.',
        ];
    }
}
