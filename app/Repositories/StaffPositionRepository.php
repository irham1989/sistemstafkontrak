<?php

namespace App\Repositories;

use App\Models\BranchPosition;
use App\Models\StaffPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffPositionRepository
{
    public function checkExistRecord($staff_id){
        $m = StaffPosition::where('staff_id',$staff_id)->first();
        if(!$m){
            $m = new StaffPosition();
            $m->staff_id = $staff_id;
            $m->save();
        }

        return $m;
    }

    public function storeUpdatePosition(Request $request){
        $staff_id = $request->staff_id;
        $branch_select = $request->branch_select;
        $position_select = $request->position_select;

        DB::beginTransaction();
        try{
            $m = $this->getStaffPosition($staff_id);
            $m->branch_position_id = $position_select;
            $m->branch_id = $branch_select;
            $m->save();

            $branchPosition = BranchPosition::find($position_select);

            $sLeave = $m->getStaffLeave;
            $sLeave->staff_position_id = $m->id;
            $sLeave->leave_total = $branchPosition->default_holiday;
            $sLeave->leave_balance = $branchPosition->default_holiday;
            $sLeave->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Jawatan Berjaya Dikemaskini'
        ];
    }

    public function getStaffPosition($staff_id){
        return StaffPosition::with('getStaff', 'getStaffLeave')->where('staff_id', $staff_id)->first();
    }
}
