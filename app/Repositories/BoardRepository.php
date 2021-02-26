<?php

namespace App\Repositories;

use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardRepository
{
    private static string $tableName = 'boards';

    /**
     * Get all project boards
     *
     * @param int $projectId
     * @return array
     */
    public static function getAll(int $projectId)
    {
        return DB::table(self::$tableName)
            ->select('id', 'project_id', 'title')
            ->where('project_id', $projectId)
            ->get()
            ->toArray();
    }

    /**
     * Get board by its id
     *
     * @param $id
     * @return mixed
     */
    public static function getById($id)
    {
        return DB::table(self::$tableName)
            ->select('id', 'title')
            ->where('id', $id)
            ->get()
            ->first();
    }

    /**
     * Create a new board
     *
     * @param $columns
     * @return Board
     */
    public static function create($columns)
    {
        $board = new Board();

        $board->fill($columns);
        $board->save();

        return $board;
    }

    /**
     * Update the board's title
     *
     * @param $id
     * @param $title
     * @return mixed
     */
    public static function edit($id, $title)
    {
        $board = Board::find($id);

        $board->title = $title;
        $board->save();

        return $board->title;
    }

    /**
     * Delete the board
     *
     * @param $id
     * @return bool
     */
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
