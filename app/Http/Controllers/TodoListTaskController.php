<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListTask\TodoListTaskRequest;
use App\Repositories\TodoListTaskRepository;
use Illuminate\Http\JsonResponse;

class TodoListTaskController extends Controller
{
    /**
     * Store a newly created TodoList task in storage.
     *
     * @param TodoListTaskRequest $request
     * @return JsonResponse
     */
    public function store(TodoListTaskRequest $request)
    {
        $newTask = TodoListTaskRepository::create($request->validated());
        $newTask = $newTask->getAttributes();

        //Delete unnecessary fields
        unset($newTask['created_at']);
        unset($newTask['updated_at']);
        unset($newTask['todo_list_id']);

        return response()->json([
            'created' => true,
            'newTask' => $newTask
        ]);
    }

    /**
     * Get the TodoList task to update.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $task = TodoListTaskRepository::getById($id);
        $found = true;
        return response()->json(compact('found', 'task'));
    }

    /**
     * Update the specified TodoList task.
     *
     * @param TodoListTaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TodoListTaskRequest $request, $id)
    {
        $updated = TodoListTaskRepository::edit($id, $request->validated());

        return response()->json(['updated' => true, 'task' => $updated]);
    }

    /**
     * Remove the specified TodoList Task from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $deleted = TodoListTaskRepository::delete($id);

        if($deleted) {
            return response()->json(['deleted' => true]);
        }

        return response()->json(['deleted' => false, 'msg' => 'Ошибка удаления.']);
    }
}
