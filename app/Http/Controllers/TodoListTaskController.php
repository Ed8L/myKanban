<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListTask\TodoListTaskRequest;
use App\Repositories\TodoListTaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
