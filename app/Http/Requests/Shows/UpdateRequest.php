<?php

namespace App\Http\Requests\Shows;

use App\Enums\ShowStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Or your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'language_id'           => [
                'required',
                'integer',
                'exists:languages,id',
            ],
            'hall_id'               => [
                'required',
                'integer',
                'exists:halls,id',
            ],
            'screen_type_id'        => [
                'required',
                'integer',
                'exists:screen_types,id',
            ],
            'show_time'             => [
                'required',
                'date',
            ],
            'status'                => [
                'nullable',
                Rule::in([
                    ShowStatus::SCHEDULED,
                    ShowStatus::SHOWING,
                    ShowStatus::ALREADY
                ]),
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
            'language_id.required'      => __('Language is required'),
            'language_id.integer'       => __('Language must be an integer'),
            'language_id.exists'        => __('Language does not exist'),
            'hall_id.required'          => __('Hall is required'),
            'hall_id.integer'           => __('Hall must be an integer'),
            'hall_id.exists'            => __('Hall does not exist'),
            'screen_type_id.required'   => __('Screen type is required'),
            'screen_type_id.integer'    => __('Screen type must be an integer'),
            'screen_type_id.exists'     => __('Screen type does not exist'),
            'show_time.required'        => __('Show time is required'),
            'show_time.date'            => __('Show time must be a valid date'),
            'status.in'                 => __('Invalid show status'),
            'status.string'             => __('Show status must be a string'),
        ];
    }
}
