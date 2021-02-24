<?php

namespace App\Repositories;

use App\Models\BoardTask;
use Illuminate\Support\Facades\DB;

class BoardTaskRepository
{
    public static function getAll($boardId)
    {
        return DB::table('board_tasks')
            ->select('id', 'board_id', 'text', 'note')
            ->where('board_id', $boardId)
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
}
