<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoListTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ToDoListTaskController extends Controller
{
    /**
     * Display all tasks for particular ToDo List
     */
    public static function index($todolistId)
    {
        return DB::table('todo_list_tasks')
            ->join('status_codes', 'todo_list_tasks.status_code_id', '=', 'status_codes.id')
            ->select('todo_list_tasks.text', 'todo_list_tasks.id', 'status_codes.title as status')
            ->where('todo_list_tasks.todo_list_id', $todolistId)
            ->orderBy('todo_list_tasks.created_at', 'desc')
            ->get();
    }

    /**
     * Create new ToDo List task
     */
    public function store(Request $request)
    {
        if(DB::table('todo_lists')->where('id', $request->todoList_id)->exists()) {
            $request->validate(['todoTask_text' => ['required', 'max:255']]);
            $newTask = new ToDoListTask();

            $newTask->todo_list_id = $request->todoList_id;
            $newTask->text = $request->todoTask_text;
            $newTask->status_code_id = 1;

            $newTask->save();

            return response()->json(
                [
                    'created' => true,
                    'newTask' => DB::table('todo_list_tasks')
                                    ->join('status_codes', 'todo_list_tasks.status_code_id', '=', 'status_codes.id')
                                    ->select('todo_list_tasks.text', 'status_codes.title as status')
                                    ->where('todo_list_tasks.id', $newTask->id)
                                    ->get()
                ]);
        }
    }

    /**
     * Update task's status
     */
    public function update(Request $request)
    {
        $status_codes = [1, 2, 3];
        $request->validate(['statusCode' => Rule::in($status_codes),]);

        $task = ToDoListTask::findOrFail($request->taskId);
        
        $task->status_code_id = $request->statusCode;

        $task->save();

        return response()->json(['updated' => true, 'updatedTask' => $task]);
    }
}
