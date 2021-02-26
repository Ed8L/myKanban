<?php

namespace App\Repositories;

use App\Models\BoardTask;
use Illuminate\Support\Facades\DB;

class BoardTaskRepository
{
    public static function getById($boardTaskId)
    {
        return DB::table('board_tasks')
            ->select('id', 'board_id', 'text', 'note')
            ->where('id', $boardTaskId)
            ->get()
            ->first();
    }

    public static function getAll($boardId)
    {
        return DB::table('board_tasks')
            ->select('id', 'board_id', 'text', 'note')
            ->where('board_id', $boardId)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }

    public static function save($columns)
    {
        $boardTask = new BoardTask;

        $boardTask->fill($columns);
        $boardTask->save();

        return $boardTask;
    }

    public static function update(int $id, array $columns)
    {
        $boardTask = BoardTask::find($id);

        $boardTask->fill($columns);
        $boardTask->save();

        return $boardTask;
    }

    public static function delete($id)
    {
        return BoardTask::destroy($id);
    }
}
