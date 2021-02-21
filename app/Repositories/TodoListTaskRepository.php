<?php

namespace App\Repositories;

use App\Models\TodoListTask;
use Illuminate\Support\Facades\DB;

class TodoListTaskRepository
{
    public static function update($id, $columns)
    {
        $task = TodoListTask::find($id);

        $task->fill($columns);
        $task->save();

        return $task;
    }

    public static function getById($id)
    {
        return DB::table('todolist_tasks')
            ->select('text', 'due', 'completed')
            ->where('id', $id)
            ->get()
            ->first();
    }

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
