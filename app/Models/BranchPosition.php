<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchPosition extends Model
{
    public function getPosition(){
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function getGrade(){
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }
}
