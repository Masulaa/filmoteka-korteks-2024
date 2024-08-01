<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
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