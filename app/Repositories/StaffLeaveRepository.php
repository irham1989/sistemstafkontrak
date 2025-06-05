<?php

namespace App\Repositories;

use App\Models\StaffLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffLeaveRepository
{
    private StaffPositionRepository $staffPositionRepository;
    public function __construct(StaffPositionRepository $staffPositionRepository){
        $this->staffPositionRepository = $staffPositionRepository;
    }

    public function checkExistRecord($staff_position_id){
        $m = StaffLeave::where('staff_position_id',$staff_position_id)->first();
        if(!$m){
            $m = new StaffLeave();
            $m->staff_position_id = $staff_position_id;
            $m->save();
        }

        return $m;
    }

    public function storeUpdateNewLeaveBalance(Request $request){
        $staff_id = $request->staff_id;
        $new_leave_balance = $request->new_leave_balance;

        $m = $this->staffPositionRepository->getStaffPosition($staff_id);
        DB::beginTransaction();
        try{
            $leave = $m->getStaffLeave;
            $leave->leave_total = $new_leave_balance;
            $leave->save();

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
            'message' => 'Jumlah Cuti Telah Dikemaskini'
        ];
    }
}
