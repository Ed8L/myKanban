<?php

namespace App\Repositories;

use App\Models\TodoListTask;
use Illuminate\Support\Facades\DB;

class TodoListTaskRepository
{
    public static function getAll($id)
    {
        return DB::table('todolist_tasks')
            ->select('id', 'text', 'due')
            ->where('todo_list_id', $id)
            ->orderByDesc('created_at')
            ->get();
    }

    public static function store(array $columns)
    {
        $newTask = new TodoListTask();

        $newTask->fill($columns);
        $newTask->save();

        return $newTask;
    }
}
