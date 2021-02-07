<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard($user_login)
    {
        return view('dashboard', ['user_login' => $user_login]);
    }
}
