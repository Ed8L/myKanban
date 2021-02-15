<?php

namespace App\Http\Controllers;

use App\Http\Requests\todolist\ToDoListTaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ToDoListTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ToDoListTaskController extends Controller
{
    /**
     * Create new ToDoList task
     * @param ToDoListTaskRequest $request
     * @return JsonResponse
     */
    public function store(ToDoListTaskRequest $request): JsonResponse
    {

    }

    /**
     * Update task's status
     */
    public function update(Request $request)
    {

    }
}
