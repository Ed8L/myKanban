<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreOrUpdateProjectRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Repositories\BoardRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ToDoListRepository;
use App\Repositories\ToDoListTasksRepository;
use phpDocumentor\Reflection\Project;

class ProjectController extends Controller
{
    /**
     * Store a newly created project in storage.
     *
     * @param StoreOrUpdateProjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateProjectRequest $request): RedirectResponse
    {
        $created = ProjectRepository::store($request->title);

        if($created) {
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
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $project = ProjectRepository::getById($id);

        if(empty($project)) {
            abort(404);
        }

        return view('project.project', compact('project'));
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
        $updated = ProjectRepository::update($id, $request->validated());

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
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(int $id)
    {
        $deleted = ProjectRepository::delete($id);

        if($deleted) {
            return response()->json(['deleted' => true]);
        } else {
            return response()->json(['deleted' => false, 'msg' => 'Ошибка удаления.']);
        }
    }
}
