<?php

namespace App\Http\Requests\Serie;

use Illuminate\Foundation\Http\FormRequest;

class SerieRequest extends FormRequest
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
            'title' => 'required|string',
            'director' => 'required|string',
            'release_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:10',
            'image' => 'nullable|image|max:2048',
            'views' => 'nullable|integer|min:0',
            'genre' => 'required|string',

        ];
    }
}
