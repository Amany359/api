<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory,HasFactory;

    protected $fillable = ['name', 'parent_id'];

    // Self-referencing relationship for parent team
    public function parent()
    {
        return $this->belongsTo(Team::class, 'parent_id');
    }

    // Team-User many-to-many relationship
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relation to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
