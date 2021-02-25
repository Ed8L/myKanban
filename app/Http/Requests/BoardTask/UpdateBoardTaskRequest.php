<?php

namespace App\Http\Requests\BoardTask;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoardTaskRequest extends FormRequest
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
            'id' => ['exists:board_tasks'],
            'text' => ['required', 'max:255'],
            'note' => ['max:500']
        ];
    }
}
