<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrantProject extends Model
{
    protected $table = 'grant_projects';

    protected $primaryKey = 'project_id';
    
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
        return $this->hasMany(Milestone::class);
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class, 'project_id');
    }
}
