<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   
    use HasFactory ,HasFactory;

    protected $fillable = ['name', 'description', 'image', 'parent_id'];

    // Self-referencing relationship (parent project)
    public function parent()
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }

    // Subprojects
    public function subprojects()
    {
        return $this->hasMany(Project::class, 'parent_id');
    }

    // Relation to Tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relation to Teams
    public function teams()
    {
        return $this->hasMany(Team::class);
        
    }
}


