<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListTask\TodoListTaskRequest;
use App\Repositories\TodoListTaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TodoListTaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param TodoListTaskRequest $request
     * @return JsonResponse
     */
    public function store(TodoListTaskRequest $request)
    {
        $newTask = TodoListTaskRepository::store($request->validated());

        $attributes = $newTask->getAttributes();

        unset($attributes['created_at']);
        unset($attributes['updated_at']);
        unset($attributes['todo_list_id']);

        return response()->json([
            'created' => true,
            'newTask' => $attributes
        ]);
    }

    public function show($id)
    {
        $task = TodoListTaskRepository::getById($id);
        $found = true;
        return response()->json(compact('found', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TodoListTaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TodoListTaskRequest $request, $id)
    {
        $updated = TodoListTaskRepository::update($id, $request->validated());

        return response()->json(['updated' => true, 'task' => $updated]);
    }

    /**
     * Remove the specified resource from storage.
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
