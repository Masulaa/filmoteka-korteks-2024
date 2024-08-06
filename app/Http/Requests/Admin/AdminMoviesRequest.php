<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminMoviesRequest extends FormRequest
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

        $rules = [];

        if ($this->isMethod('post')) {
            $rules = [
                'title' => 'required|string|max:255',
                'director' => 'required|string|max:255',
                'release_date' => 'required|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'trailer_link' => 'nullable|url',
                'video_id' => 'nullable|integer',
                'views' => 'nullable|integer|min:0',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'title' => 'required|string|max:255',
                'director' => 'required|string|max:255',
                'release_date' => 'required|date',
                'genre' => 'string|max:255',
                'trailer_link' => 'nullable|url',
                'video_id' => 'nullable|integer',
                'views' => 'nullable|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        }

        return $rules;

    }
}
