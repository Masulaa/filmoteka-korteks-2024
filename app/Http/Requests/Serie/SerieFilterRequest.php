<?php

namespace App\Http\Requests\Serie;

use Illuminate\Foundation\Http\FormRequest;

class SerieFilterRequest extends FormRequest
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
            'genre' => 'nullable|string',
            'min_year' => 'nullable|integer',
            'max_year' => 'nullable|integer',
            'most_viewed' => 'nullable|boolean',
            'highest_rated' => 'nullable|boolean',
        ];
    }
}
