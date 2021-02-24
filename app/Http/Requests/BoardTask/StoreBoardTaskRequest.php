<?php

namespace App\Http\Requests\BoardTask;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoardTaskRequest extends FormRequest
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
            'board_id' => ['required', 'exists:boards,id'],
            'text' => ['required', 'max:255'],
            'note' => ['max:500']
        ];
    }

    public function messages()
    {
        return [
            'board_id.required' => 'Ошибка сохранения.',
            'board_id.exists' => 'Ошибка сохранения.',
        ];
    }
}
