<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Shows user's profile page
     */
    public function showUserProfile()
    {
        $projects = ProjectController::index(auth()->user()->id);

        return view('user_profile', ['projects' => $projects]);
    }
}
