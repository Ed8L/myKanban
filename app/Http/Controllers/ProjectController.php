<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\BoardController;

class ProjectController extends Controller
{
    /**
     * Get all projects of specific user
     *
     * @param int $user_id
     * @return \Illuminate\Support\Facades\DB
     */
    public static function index(int $user_id)
    {
        return DB::table('projects')->where('user_id', '=', $user_id)->select('id', 'title')->get();
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \App\Http\Requests\StoreOrUpdateProject  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => ['required', 'string', 'max:255']]);
        $project = new Project;

        $project->user_id = auth()->user()->id;
        $project->title = $request->title;
        $project->save();

        return response()->json(['created' => true, 'newProject' => $project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = DB::table('projects')->select('id', 'title')->where('id', '=', $id);
        $todoList = ToDoListController::index($id);
        $todoListTasks = ToDoListTaskController::index($id);
        $boards = BoardController::index($id);
        $taskStatuses = StatusCodesController::getAll();
        
        if($project->exists()){
            return view('projects.project', [
                'project' => $project->first(),
                'todolist' => $todoList,
                'boards' => $boards,
                'todoListTasks' => $todoListTasks,
                'statuses' => $taskStatuses
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
