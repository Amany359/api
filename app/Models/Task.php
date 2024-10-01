<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory ,HasFactory;

    protected $fillable = ['title', 'description', 'status', 'project_id', 'assigned_to'];

    // Relation to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relation to the user assigned to the task
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
