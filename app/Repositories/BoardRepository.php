<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BoardRepository
{
    /**
     * Get all project's tasks
     *
     * @param int $project_id
     * @return Collection
     */

    public static function getAll(int $project_id): Collection
    {
        return DB::table('boards')
            ->select('id', 'project_id', 'title')
            ->where('project_id', '=', $project_id)
            ->get();
    }
}
