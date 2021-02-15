<?php

namespace App\Http\Controllers;

use App\Http\Requests\todolist\ToDoListRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\ToDoListRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    /**
     * Store a newly created ToDoList.
     *
     * @param ToDoListRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(ToDoListRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
