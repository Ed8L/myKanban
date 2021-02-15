<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;

class PageController extends Controller
{
    /**
     * Shows user's profile page
     */
    public function showUserProfile()
    {
        $projects = ProjectRepository::getAll();

        return view('user_profile', compact('projects'));
    }
}
