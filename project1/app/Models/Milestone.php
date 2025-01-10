<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'target_completion_date',
        'deliverable',
        'status',
        'remark',
        'last_updated'
    ];

    public function project()
    {
        return $this->belongsTo(GrantProject::class);
    }
}
