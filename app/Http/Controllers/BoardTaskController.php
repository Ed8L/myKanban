<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardTask\StoreBoardTaskRequest;
use App\Http\Requests\BoardTask\UpdateBoardTaskRequest;
use App\Repositories\BoardTaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BoardTaskController extends Controller
{
    /**
     * Store a newly created board task in storage.
     *
     * @param StoreBoardTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreBoardTaskRequest $request)
    {
        $newBoardTask = BoardTaskRepository::create($request->validated());
        $newBoardTask = $newBoardTask->getAttributes();

        //Delete unnecessary fields
        unset($newBoardTask['created_at']);
        unset($newBoardTask['updated_at']);
        unset($newBoardTask['board_id']);

        return response()->json(['success' => true, 'boardTask' => $newBoardTask]);
    }

    /**
     * Get the board task data to update.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $boardTask = BoardTaskRepository::getById($id);

        return response()->json(['success' => true, 'boardTask' => $boardTask]);
    }

    /**
     * Update a board task
     *
     * @param UpdateBoardTaskRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateBoardTaskRequest $request, $id)
    {
        $boardTask = BoardTaskRepository::edit($id, $request->validated());

        return response()->json(['success' => true, 'boardTask' => $boardTask]);
    }

    /**
     * Update a board task's parent
     *
     * @param Request $request
     * @param $id
     */
    public function updateBoard(Request $request, $id)
    {
        BoardTaskRepository::edit($id, ['board_id' => $request->boardId]);
    }

    /**
     * Delete a board task
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $deleted = BoardTaskRepository::delete($id);

        if($deleted) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'msg' => 'Ошибка удаления']);
    }
}
