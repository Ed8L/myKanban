<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreOrUpdateProjectRequest;
use App\Models\TodoList;
use App\Repositories\BoardRepository;
use App\Repositories\BoardTaskRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Repositories\ProjectRepository;
use App\Repositories\TodoListRepository;

class ProjectController extends Controller
{
    /**
     * Display user's all projects.
     * @return Application|Factory|View
     */
    public function index()
    {
        $projects = ProjectRepository::getAll();

        return view('user_profile', compact('projects'));
    }

    /**
     * Store a newly created project in storage.
     *
     * @param StoreOrUpdateProjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateProjectRequest $request)
    {
        $created = ProjectRepository::create($request->title);

        if ($created) {
            return redirect()
                ->route('userProfile')
                ->with('success', 'Проект создан!');
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения.'])
                ->withInput();
        }
    }

    /**
     * Display the specified project.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $projectId)
    {
        $project = ProjectRepository::getById($projectId);
        if (empty($project)) {
            abort(404);
        }

        $data = ['project']; // data that'll be passed to the view by compact() function

        $todo = TodoListRepository::getTodo($projectId);
        $boards = BoardRepository::getAll($projectId);

        if (!empty($todo)) {
            $todoTasks = TodoList::find($todo->id)->tasks->sortDesc();
            array_push($data, 'todo', 'todoTasks');
        }
        if (!empty($boards)) {
            foreach($boards as $board) {
                $boardTasksArray[] = BoardTaskRepository::getAll($board->id);
            }

            array_push($data, 'boards', 'boardTasksArray');
        }

        return view('project.show', compact($data));
    }

    /**
     * Update the project
     *
     * @param StoreOrUpdateProjectRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreOrUpdateProjectRequest $request, int $id): JsonResponse
    {
        $updated = ProjectRepository::edit($id, $request->validated());

        if ($updated) {
            return response()->json([
                'updated' => true,
                'updatedTitle' => $updated->title
            ]);
        }

        return response()->json([
            'updated' => false,
            'msg' => 'Ошибка сохранения'
        ]);
    }

    /**
     * Delete the the project.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = ProjectRepository::delete($id);

        if ($deleted) {
            return response()->json(['deleted' => true]);
        } else {
            return response()->json(['deleted' => false, 'msg' => 'Ошибка удаления.']);
        }
    }
}
