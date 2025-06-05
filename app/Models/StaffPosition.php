<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    public function getStaff(){
        return $this->hasOne(Staff::class,'id','staff_id');
    }

    public function getStaffLeave(){
        return $this->hasOne(StaffLeave::class,'staff_position_id','id');
    }

    public function getBranch(){
        return $this->hasOne(Branch::class,'id','branch_id');
    }

    public function getBranchPosition(){
        return $this->hasOne(BranchPosition::class,'id','branch_position_id');
    }
}
