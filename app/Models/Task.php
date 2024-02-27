<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'todo',
        'in_progress',
        'done',
        'created_at',
        'updated_at'
    ];
}
