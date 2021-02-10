<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_codes')->insert([
            ['title' => 'Не выполнено', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['title' => 'Выполнено', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['title' => 'В процессе', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ]);
    }
}
