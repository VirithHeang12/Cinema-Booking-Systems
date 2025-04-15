<?php

namespace App\Http\Requests\Shows;

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
            'show_time' => 'required|date',
            'status' => ['nullable', 'string', Rule::in(['Scheduled', 'Showing', 'Already'])],
            'movie_subtitle_id' => 'nullable|exists:movie_subtitles,id',
            'hall_id' => 'nullable|exists:halls,id',
            'screen_type_id' => 'nullable|exists:screen_types,id',
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
            'show_time.required' => 'The show time is required.',
            'show_time.date' => 'The show time must be a valid date and time.',
            'status.in' => 'The status must be one of the following: Scheduled, Showing, Already.',
            'movie_subtitle_id.exists' => 'The selected movie subtitle is invalid.',
            'hall_id.exists' => 'The selected hall is invalid.',
            'screen_type_id.exists' => 'The selected screen type is invalid.',
        ];
    }
}