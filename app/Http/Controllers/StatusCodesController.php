<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatusCodesController extends Controller
{
    /**
     * Get all status codes with titles
     */
    public static function getAll()
    {
        return DB::table('status_codes')->select(['id', 'title'])->get();
    }
}
