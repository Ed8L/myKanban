<?php


namespace app\Repositories;

use App\Models\TodoList;
use Illuminate\Support\Facades\DB;

class TodoListRepository
{
    /**
     * Store a new todoList
     *
     * @param $projectId
     * @return TodoList
     */
    public static function store($projectId)
    {
        $todo = new TodoList();

        $todo->project_id = $projectId;
        $todo->save();

        return $todo;
    }

    public static function delete($projectId)
    {
        if(self::exists($projectId)) {
            $todo = TodoList::where('project_id', $projectId)
                ->first();
            return $todo->delete();
        }

        return false;
    }

    public static function getTodo($projectId)
    {
        return DB::table('todo_lists')
            ->where('project_id', $projectId)
            ->select('id')
            ->first();
    }

    /**
     * Check if the todoList exists
     *
     * @param $projectId
     * @return bool
     */
    private static function exists($projectId): bool
    {
        return DB::table('todo_lists')->where('project_id', $projectId)->exists();
    }
}
