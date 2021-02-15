<?php

namespace App\Repositories;

use App\Models\ToDoList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ToDoListRepository
{
    /**
     * Get project's ToDoList
     *
     * @param int $project_id
     * @return Collection
     */
    public static function get(int $project_id): Collection
    {
        return DB::table('todo_lists')
            ->where('project_id', $project_id)
            ->select('id', 'project_id')
            ->get();
    }

    public static function store($projectId)
    {
        $todoList = new ToDoList();

        $todoList->project_id = $projectId;
        $todoList->save();

        return $todoList;
    }
}
