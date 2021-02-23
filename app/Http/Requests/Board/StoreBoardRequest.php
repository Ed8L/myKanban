<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'project_id' => ['required', 'exists:projects,id']
        ];
    }

    /**
     * Get the custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project_id.exists' => 'Ошибка сохранения.',
            'project_id.required' => 'Ошибка сохранения.',
        ];
    }
}
