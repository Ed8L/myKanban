<?php

namespace App\Http\Controllers;

use App\Repositories\TodoListRepository;
use App\Http\Requests\todolist\StoreTodoListRequest;

class TodoListController extends Controller
{
    /**
     * Store a newly created TodoList in storage
     *
     * @param StoreTodoListRequest $request
     */
    public function store(StoreTodoListRequest $request)
    {
        $projectId = $request->id;

        $todo = TodoListRepository::store($projectId);

        return back()->with('success', 'Todo создан!');
    }

    public function destroy($id)
    {
        $deleted = TodoListRepository::delete($id);

        if($deleted) {
            return back()
                ->with('success', 'Todo удалён!');
        }

        return back()
            ->withErrors(['msg' => 'Ошибка удаления.']);
    }
}
