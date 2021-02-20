<?php

namespace App\Http\Requests\TodoListTask;

use Illuminate\Foundation\Http\FormRequest;

class TodoListTaskRequest extends FormRequest
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
            'text' => ['required'],
            'due' => ['date'],
            'todo_list_id' => ['exists:todo_lists,id']
        ];
    }
}
