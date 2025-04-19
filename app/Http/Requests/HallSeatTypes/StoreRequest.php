<?php

namespace App\Http\Requests\HallSeatTypes;

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
            'seat_type_id'    => [
                'required',
                'integer',
                'exists:seat_types,id',
            ],
            'maximum_capacity' => [
                'required',
                'integer',
                'min:1',
            ],
            'rows'           => [
                'required',
                'array',
            ],
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
            'seat_type_id.required'     => 'The seat type field is required.',
            'seat_type_id.integer'      => 'The seat type field must be an integer.',
            'seat_type_id.exists'       => 'The selected seat type is invalid.',
            'maximum_capacity.required' => 'The maximum capacity field is required.',
            'maximum_capacity.integer'  => 'The maximum capacity field must be an integer.',
            'maximum_capacity.min'      => 'The maximum capacity must be at least :min.',
            'rows.required'             => 'The rows field is required.',
            'rows.array'                => 'The rows field must be an array.',
        ];
    }
}
