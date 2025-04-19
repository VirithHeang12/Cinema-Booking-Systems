<?php

namespace App\Http\Requests\Movies;

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
            'title'                     => 'required|string|max:255',
            'description'               => 'nullable|string|max:1000',
            'release_date'              => 'required|date',
            'classification_id'         => 'required|exists:classifications,id',
            'rating'                    => 'nullable|numeric|min:1|max:10',
            'duration'                  => 'required|integer|min:1',
            'thumbnail_file'            => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'trailer_url'               => 'required|url|max:255',
            'country_id'                => 'required|exists:countries,id',
            'spoken_language_id'        => 'required|exists:languages,id',
            'movieGenres'               => 'array',
            'movieSubtitles'            => 'array',
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
            'title.required'                => 'The title is required.',
            'description.max'               => 'The description may not be greater than 1000 characters.',
            'release_date.required'         => 'The release date is required.',
            'classification_id.required'    => 'The classification is required.',
            'rating.numeric'                => 'The rating must be a number.',
            'rating.min'                    => 'The rating must be at least 1.',
            'rating.max'                    => 'The rating may not be greater than 10.',
            'duration.required'             => 'The duration is required.',
            'duration.integer'              => 'The duration must be an integer.',
            'duration.min'                  => 'The duration must be at least 1 minute.',
            'thumbnail_file.image'          => 'The thumbnail must be an image.',
            'thumbnail_file.max'            => 'The thumbnail may not be greater than 2MB.',
            'thumbnail_file.mimes'          => 'The thumbnail must be a file of type: jpeg, png, jpg.',
            'trailer_url.url'               => 'The trailer URL must be a valid URL.',
            'trailer_url.required'          => 'The trailer URL is required.',
            'country_id.required'           => 'The country is required.',
            'spoken_language_id.required'   => 'The spoken language is required.',
        ];
    }
}
