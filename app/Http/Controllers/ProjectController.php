<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return DB::table('projects')->where('user_id', '=', $user_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \App\Http\Requests\StoreOrUpdateProject  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateProject $request)
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
