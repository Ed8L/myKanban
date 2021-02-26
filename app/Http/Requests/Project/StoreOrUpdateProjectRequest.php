<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules to incoming request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'exists:projects',
            'title' => 'required|string|max:255'
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.exists' => 'Ошибка сохранения.',
            'title.required' => 'Введите название проекта.'
        ];
    }
}
