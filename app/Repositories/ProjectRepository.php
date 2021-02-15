<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class ProjectRepository
{
    private static array $fields = ['id', 'title'];

    /**
     * Get all user projects
     *
     * @return Collection
     */
    public static function getAll():Collection
    {
        return DB::table('projects')
            ->where('user_id', auth()->user()->id)
            ->select(self::$fields)
            ->get();
    }

    /**
     * Get user project by its id
     *
     * @param int $id
     * @return mixed
     */
    public static function getById(int $id)
    {
        return DB::table('projects')
            ->where('id', $id)
            ->select(self::$fields)
            ->get()
            ->first();
    }

    /**
     * @param $title
     * @return Project
     */
    public static function store($title): Project
    {
        $newProject = new Project;

        $newProject->user_id = auth()->user()->id;
        $newProject->title = $title;
        $newProject->save();

        return $newProject;
    }

    /**
     * Update the project
     *
     * @param int $project_id
     * @param array $fields
     * @return mixed
     */
    public static function update(int $project_id, array $fields)
    {
        if(self::exists($project_id)) {
            $project = Project::find($project_id);

            $project->fill($fields);
            $project->save();

            return $project;
        }

        return false;
    }

    /**
     * Delete the project
     *
     * @param $project_id
     */
    public static function delete($project_id)
    {
        if(self::exists($project_id)) {
            $project = Project::find($project_id);
            return $project->delete();
        }
        return false;
    }

    /**
     * Check if the project exists
     *
     * @param $projectId
     * @return bool
     */
    private static function exists($projectId)
    {
        return DB::table('projects')->where('id', $projectId)->exists();
    }
}
