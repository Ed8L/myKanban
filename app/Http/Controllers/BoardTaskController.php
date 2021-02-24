<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardTask\StoreBoardTaskRequest;
use App\Repositories\BoardTaskRepository;
use Illuminate\Http\JsonResponse;

class BoardTaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBoardTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreBoardTaskRequest $request)
    {
        $newBoardTask = BoardTaskRepository::save($request->validated());
        $newBoardTask = $newBoardTask->getAttributes();

        //Delete unnecessary fields
        unset($newBoardTask['created_at']);
        unset($newBoardTask['updated_at']);
        unset($newBoardTask['board_id']);

        return response()->json(['success' => true, 'boardTask' => $newBoardTask]);
    }
}
