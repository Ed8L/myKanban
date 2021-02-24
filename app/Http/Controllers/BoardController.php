<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\StoreBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\BoardRepository;

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
        $board = BoardRepository::store($request->validated());

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
        $board = BoardRepository::getById($id);

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
        $boardTitle = BoardRepository::update($id, $request->title);

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
        $deleted = BoardRepository::delete($id);

        return response()->json(compact('deleted'));
    }
}
