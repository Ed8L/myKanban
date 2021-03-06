<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title'];

    public function tasks()
    {
        return $this->hasMany(BoardTask::class);
    }
}
