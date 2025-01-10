<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
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

    public function grantproject()
    {
        return $this->belongsTo(GrantProject::class, 'project_id');
    }
}
