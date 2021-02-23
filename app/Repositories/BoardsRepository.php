<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BoardsRepository
{
    /**
     * Get all project boards
     *
     * @param int $projectId
     * @return array
     */
    public static function getAll(int $projectId)
    {
        return DB::table('boards')
            ->select('project_id', 'title')
            ->where('project_id', $projectId)
            ->get()
            ->toArray();
    }
}
