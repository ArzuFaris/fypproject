<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrantProject extends Model
{
    protected $fillable = [
        'project_id',
        'academician_id',
        'title',
        'grant_amount',
        'grant_provider',
        'start_date',
        'duration'
    ];

    public function academicians(){
        return $this->belongsTo(Academician::class, 'academician_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'project_id');
    }
}
