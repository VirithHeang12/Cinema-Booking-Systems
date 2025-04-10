<?php

namespace App\Http\Requests\HallTypes;

use Illuminate\Foundation\Http\FormRequest;

class ImportHallTypesRequest extends FormRequest
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
            'file'          => 'required|file|mimes:xlsx,xls,csv,txt|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'file.required' => __('The file is required.'),
            'file.file'     => __('The file must be a file.'),
            'file.mimes'    => __('The file must be a file of type: xlsx, xls, csv, txt.'),
            'file.max'      => __('The file may not be greater than 2MB.'),
        ];
    }
}
