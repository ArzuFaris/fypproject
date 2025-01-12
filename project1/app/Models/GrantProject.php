<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrantProject extends Model
{
    protected $table = 'grant_projects';  // Specify the correct table name
    protected $primaryKey = 'project_id';
    public $incrementing = false;  // Since project_id is a string
    protected $keyType = 'string';
    
    protected $fillable = [
        'project_id',
        'academician_id',
        'title',
        'grant_amount',
        'grant_provider',
        'start_date',
        'duration'
    ];

    public function projectLeader()
    {
        return $this->belongsTo(Academician::class, 'academician_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class,'project_id', 'project_id');
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class, 'project_id');
    }
}
