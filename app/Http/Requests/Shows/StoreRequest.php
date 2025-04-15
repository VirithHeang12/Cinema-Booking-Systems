<?php

namespace App\Http\Requests\Shows;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'movie_subtitle_id' => [
                'required',
                'integer',
                'exists:movie_subtitles,id', 
            ],
            'hall_id' => [
                'required',
                'integer',
                'exists:halls,id',
            ],
            'screen_type_id' => [
                'required',
                'integer',
                'exists:screen_types,id',
            ],
            'show_time' => 'required|date',
            'status' => [
                'nullable',
                Rule::in(['Scheduled', 'Showing', 'Already']),
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
            'movie_subtitle_id.required' => __('Movie & Subtitle is required'),
            'movie_subtitle_id.integer' => __('Invalid Movie & Subtitle format.'),
            'movie_subtitle_id.exists' => __('Selected Movie & Subtitle does not exist.'),
            'hall_id.required' => __('Hall is required'),
            'hall_id.integer' => __('Invalid Hall format.'),
            'hall_id.exists' => __('Selected Hall does not exist.'),
            'screen_type_id.required' => __('Screen Type is required'),
            'screen_type_id.integer' => __('Invalid Screen Type format.'),
            'screen_type_id.exists' => __('Selected Screen Type does not exist.'),
            'show_time.required' => __('Show Time is required'),
            'show_time.date' => __('Invalid Show Time format.'),
            'status.in' => __('Invalid Show Status.'),
        ];
    }
}
