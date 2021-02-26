<?php

namespace App\Repositories;

use App\Models\TodoListTask;
use Illuminate\Support\Facades\DB;

class TodoListTaskRepository
{
    private static string $tableName = 'todolist_tasks';

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
     * Create a new TodoList task
     *
     * @param array $columns
     * @return TodoListTask
     */
    public static function create(array $columns)
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
    public static function edit($id, $columns)
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
}
