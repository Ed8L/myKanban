<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($project_id)
    {
        return DB::table('todo_lists')->where('project_id', '=', $project_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectId = $request->project_id;

        if(DB::table('projects')->where('id', $projectId)->exists()) {

            if(DB::table('todo_lists')->where('project_id', $projectId)->exists()) {
                return response()->json(['created' => false, 'message' => 'Можно создать только один To Do список на один проект']);
            }

            $todo = new ToDoList();

            $todo->project_id = $projectId;
            $todo->save();

            return response()->json(['created' => true, 'new_todo' => $todo]);
        }

        return redirect()->back();
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
