<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ToDoListTasksRepository
{
    /**
     * Get all ToDoList's tasks
     *
     * @param int $todoListId
     * @return Collection
     */
    public static function getAll(int $todoListId): Collection
    {
        return DB::table('todo_list_tasks')
            ->join('status_codes', 'todo_list_tasks.status_code_id', '=', 'status_codes.id')
            ->select('todo_list_tasks.id', 'todo_list_tasks.text', 'status_codes.title as status', 'status_codes.id as status_id')
            ->where('todo_list_tasks.todo_list_id', $todoListId)
            ->orderBy('todo_list_tasks.created_at', 'desc')
            ->get();
    }
}
