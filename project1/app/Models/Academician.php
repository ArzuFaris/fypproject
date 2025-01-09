<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academician extends Model
{
    protected $fillable = [
        //'academician_id',
        'academician_name',
        'academician_number',
        'email',
        'college',
        'department',
        'position'
    ];

    
    public function grantprojects(){
        return $this->hasMany(GrantProject::class);
    }

}

