<?php

namespace App\Http\Controllers;

use App\Repositories\TodoListRepository;
use App\Http\Requests\todolist\StoreTodoListRequest;
use Illuminate\Http\RedirectResponse;

class TodoListController extends Controller
{
    /**
     * Store a newly created TodoList in storage
     *
     * @param StoreTodoListRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTodoListRequest $request)
    {
        $projectId = $request->id;

        TodoListRepository::create($projectId);

        return back()->with('success', 'ToDo создан!');
    }

    /**
     * Delete TodoList
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $deleted = TodoListRepository::delete($id);

        if($deleted) {
            return back()
                ->with('success', 'ToDo удалён!');
        }

        return back()
            ->withErrors(['msg' => 'Ошибка удаления.']);
    }
}
