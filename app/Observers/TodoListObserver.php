<?php

namespace App\Observers;

use App\Models\TodoList;
use Illuminate\Support\Facades\DB;

class TodoListObserver
{
    /**
     * Handle the TodoList "deleted" event.
     *
     * @param TodoList $todoList
     * @return void
     */
    public function deleted(TodoList $todoList)
    {
        DB::table('todolist_tasks')
            ->where('todo_list_id', $todoList->id)
            ->delete();
    }
}
