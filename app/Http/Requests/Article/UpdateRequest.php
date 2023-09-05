<?php

namespace App\Http\Requests\Article;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('activities', 'title')->ignore($this->activity)],
            'description' => ['required', 'string'],
            'thumbnail' => ['sometimes','nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
            'tags' => ['nullable', 'array'],
            'content' => ['required', 'string'],
        ];
    }
}
