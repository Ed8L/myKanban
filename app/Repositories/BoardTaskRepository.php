<?php

namespace App\Repositories;

use App\Models\BoardTask;
use Illuminate\Support\Facades\DB;

class BoardTaskRepository
{
    private static string $tableName = 'board_tasks';

    /**
     * Get all board's tasks
     *
     * @param $boardId
     * @return array
     */
    public static function getAll(int $boardId)
    {
        return DB::table(self::$tableName)
            ->where('board_id', $boardId)
            ->select('id', 'board_id', 'text', 'note')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Get board's task
     *
     * @param $boardTaskId
     * @return mixed
     */
    public static function getById(int $boardTaskId)
    {
        return DB::table(self::$tableName)
            ->where('id', $boardTaskId)
            ->select('id', 'board_id', 'text', 'note')
            ->get()
            ->first();
    }

    /**
     * Create a new board task
     *
     * @param $columns
     * @return BoardTask
     */
    public static function create(array $columns)
    {
        $boardTask = new BoardTask;

        $boardTask->fill($columns);
        $boardTask->save();

        return $boardTask;
    }

    /**
     * Edit the board's task
     *
     * @param int $id
     * @param array $columns
     * @return mixed
     */
    public static function edit(int $id, array $columns)
    {
        $boardTask = BoardTask::find($id);

        $boardTask->fill($columns);
        $boardTask->save();

        return $boardTask;
    }

    /**
     * Delete the board's task
     *
     * @param int $id
     * @return int
     */
    public static function delete(int $id)
    {
        return BoardTask::destroy($id);
    }
}
