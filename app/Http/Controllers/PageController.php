<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Shows user's profile page
     */
    public function userProfile($user_login)
    {
        $projects = ProjectController::index(auth()->user()->id);

        return view('user_profile', ['user_login' => $user_login, 'projects' => $projects]);
    }
}
