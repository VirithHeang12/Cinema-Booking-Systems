<?php

namespace App\Http\Requests\SeatTypes;

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
            'name'          => 'required|string|max:50|unique:seat_types',
            'description'   => 'string|max:255',
            'price'         => 'required|numeric|min:1',
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
            'name.string'           => 'Name must be a string',
            'name.max'              => 'Name must not be greater than 50 characters',
            'name.unique'           => 'Name must be unique',
            'description.string'    => 'Description must be a string',
            'description.max'       => 'Description must not be greater than 255 characters',
            'price.required'        => 'Price is required',
            'price.numeric'         => 'Price must be a number',
            'price.min'             => 'Price must be at least 1',
        ];
    }
}
