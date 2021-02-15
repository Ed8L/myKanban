<?php

namespace App\Http\Requests\todolist;

use Illuminate\Foundation\Http\FormRequest;

class ToDoListTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'todoTaskText' => ['required', 'max:255']
        ];
    }
}
