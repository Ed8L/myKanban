<?php

namespace App\Repositories;

use App\Models\TodoListTask;
use Illuminate\Support\Facades\DB;

class TodoListTaskRepository
{
    public static function getAll()
    {
        return DB::table('todolist_tasks')
            ->select('id', 'text', 'due')
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
