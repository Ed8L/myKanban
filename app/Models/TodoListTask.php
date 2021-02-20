<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TodoListTask extends Model
{
    use HasFactory;

    protected $table = 'todolist_tasks';
    protected $fillable = ['todo_list_id', 'text', 'due'];
}
