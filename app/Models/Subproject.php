<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subproject extends Model
{
    use HasFactory ,HasFactory;
    protected $fillable = ['name', 'description', 'parent_id'];

    // Relationship to parent project
    public function project()
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }
}
