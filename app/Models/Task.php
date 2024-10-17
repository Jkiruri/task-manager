<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Specify the table name (optional if using default 'tasks')
    protected $table = 'tasks';

    // Mass-assignable attributes
    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'due_date'
    ];

    // Default attribute values
    protected $attributes = [
        'status' => 'pending',
    ];

    // Cast fields to appropriate data types
    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
