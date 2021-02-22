<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class ProjectRepository
{
    private static array $columns = ['id', 'title'];
    private static string $tableName = 'projects';

    /**
     * Get all user projects
     *
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return DB::table(self::$tableName)
            ->where('user_id', auth()->user()->id)
            ->select(self::$columns)
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
        return DB::table(self::$tableName)
            ->select(self::$columns)
            ->find($id);
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
     * @param array $columns
     * @return mixed
     */
    public static function update(int $project_id, array $columns)
    {
        if (self::exists($project_id)) {
            $project = Project::find($project_id);

            $project->fill($columns);
            $project->save();

            return $project;
        }

        return false;
    }

    /**
     * Delete the project
     *
     * @param $project_id
     * @return false
     */
    public static function delete($project_id): bool
    {
        if (self::exists($project_id)) {
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
    private static function exists($projectId): bool
    {
        return DB::table('projects')->where('id', $projectId)->exists();
    }
}
