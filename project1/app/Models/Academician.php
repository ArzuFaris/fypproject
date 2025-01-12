<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academician extends Model
{
    protected $fillable = [
        'academician_id',
        'user_id',
        'academician_name',
        'academician_number',
        'email',
        'college',
        'department',
        'position'
    ];

    
    public function ledProjects()
    {
        return $this->hasMany(GrantProject::class, 'academician_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

