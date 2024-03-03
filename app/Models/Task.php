<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', // Name of the task
        'description', // Description of the task
        'status', // Status of the task (e.g., pending, completed)
        // Any other fields you may need
    ];
}
