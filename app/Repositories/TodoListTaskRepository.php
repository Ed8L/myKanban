<?php

namespace App\Repositories;

use App\Models\TodoListTask;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TodoListTaskRepository
{
    private static string $tableName = 'todolist_tasks';

    /**
     * Store a newly created task
     *
     * @param array $columns
     * @return TodoListTask
     */
    public static function store(array $columns)
    {
        $newTask = new TodoListTask();

        $newTask->fill($columns);
        $newTask->save();

        return $newTask;
    }

    /**
     * Update a task's text, due and completed status
     *
     * @param $id
     * @param $columns
     * @return mixed
     */
    public static function update($id, $columns)
    {
        $task = TodoListTask::find($id);

        $task->fill($columns);
        $task->save();

        return $task;
    }

    /**
     * Delete the task
     *
     * @param $id
     * @return int
     */
    public static function delete($id): int
    {
        return TodoListTask::destroy($id);
    }

    /**
     * Get the specific task
     *
     * @param $id
     * @return mixed
     */
    public static function getById($id)
    {
        return DB::table(self::$tableName)
            ->select('text', 'due', 'completed')
            ->where('id', $id)
            ->get()
            ->first();
    }

    /**
     * Get all tasks for a todoList
     *
     * @param $id
     * @return Collection
     */
    public static function getAll($id)
    {
        return DB::table(self::$tableName)
            ->select('id', 'text', 'due')
            ->where('todo_list_id', $id)
            ->orderByDesc('created_at')
            ->get();
    }
}
