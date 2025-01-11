<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $table = 'milestones';
    
    protected $fillable = [
        'milestone_id',
        'project_id',
        'name',
        'target_completion_date',
        'deliverable',
        'status',
        'remark',
        'last_updated'
    ];

    public function grantProject()
    {
        //return $this->belongsTo(GrantProject::class);
        return $this->belongsTo(
            GrantProject::class,
            'project_id',        // Foreign key on milestones table
            'project_id'         // Primary key on grant_projects table
        );
    }
}
