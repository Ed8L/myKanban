<?php


namespace app\Repositories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TodoListRepository
{
    private static string $tableName = 'todo_lists';
    /**
     * Returns a TodoList by it's project_id
     *
     * @param int $projectId
     * @return Model|Builder|object|null
     */
    public static function getTodo(int $projectId)
    {
        return DB::table(self::$tableName)
            ->where('project_id', $projectId)
            ->select('id')
            ->first();
    }

    /**
     * Create a new TodoList
     *
     * @param $projectId
     * @return TodoList
     */
    public static function create($projectId)
    {
        $todo = new TodoList();

        $todo->project_id = $projectId;
        $todo->save();

        return $todo;
    }

    /**
     * Check if the todoList exists
     *
     * @param $projectId
     * @return bool
     */
    private static function exists(int $projectId)
    {
        return DB::table('todo_lists')->where('project_id', $projectId)->exists();
    }

    /**
     * Delete the TodoList
     *
     * @param int $projectId
     * @return bool
     */
    public static function delete(int $projectId)
    {
        if (self::exists($projectId)) {
            $todo = TodoList::where('project_id', $projectId)
                ->first();
            return $todo->delete();
        }

        return false;
    }
}
