<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffLeaveEntry extends Model
{
    public function getStaffPosition(){
        return $this->hasOne(StaffPosition::class,'id','staff_position_id');
    }

    public function getStaffLeave(){
        return $this->hasOne(StaffLeave::class,'id','staff_leave_id');
    }

    public function getApprover(){
        return $this->hasOne(Staff::class,'id','approver_id')->with('getUser');
    }
}
