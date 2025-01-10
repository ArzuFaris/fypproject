<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = 'project_members';

    protected $primaryKey = 'project_member_id';    

    protected $fillable = [
        'project_member_id',
        'project_id',
        'academician_id',
        'role'
    ];  

    public function grantProject()
    {
        return $this->belongsTo(GrantProject::class, 'project_id');
    }   

    public function academician()
    {
        return $this->belongsTo(Academician::class, 'academician_id');
    }
}
