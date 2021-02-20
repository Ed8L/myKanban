<?php


namespace app\Repositories;


use Illuminate\Support\Facades\DB;

class TodoListTasksRepository
{
    public static function getAll($todoListId)
    {
        return DB::table('todo_tasks');
    }
}
