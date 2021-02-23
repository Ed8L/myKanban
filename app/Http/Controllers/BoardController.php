<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\StoreBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\BoardsRepository;

class BoardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBoardRequest $request
     * @return JsonResponse
     */
    public function store(StoreBoardRequest $request)
    {
        $board = BoardsRepository::store($request->validated());

        return response()->json(['created' => true, 'board' => $board]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $board = BoardsRepository::getById($id);

        if(!empty($board)) {
            return response()->json(compact('board'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBoardRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBoardRequest $request, $id)
    {
        $boardTitle = BoardsRepository::update($id, $request->title);

        return response()->json(['updated' => true, 'newTitle' => $boardTitle]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $deleted = BoardsRepository::delete($id);

        return response()->json(compact('deleted'));
    }
}
