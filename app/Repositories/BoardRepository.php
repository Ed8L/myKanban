<?php

namespace App\Repositories;

use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardRepository
{
    /**
     * Get board by id
     *
     * @param $id
     * @return mixed
     */
    public static function getById($id)
    {
        return DB::table('boards')
            ->select('id', 'title')
            ->where('id', $id)
            ->get()
            ->first();
    }

    /**
     * Get all project boards
     *
     * @param int $projectId
     * @return array
     */
    public static function getAll(int $projectId)
    {
        return DB::table('boards')
            ->select('id', 'project_id', 'title')
            ->where('project_id', $projectId)
            ->get()
            ->toArray();
    }

    /**
     * Update the board's title
     *
     * @param $id
     * @param $title
     * @return mixed
     */
    public static function update($id, $title)
    {
        $board = Board::find($id);

        $board->title = $title;
        $board->save();

        return $board->title;
    }

    /**
     * Save board to database
     *
     * @param $columns
     * @return Board
     */
    public static function store($columns)
    {
        $board = new Board();

        $board->fill($columns);
        $board->save();

        return $board;
    }

    public static function delete($id)
    {
        $board = Board::find($id);

        if (!empty($board)) {
            $board->delete();
            return true;
        }

        return false;
    }
}
