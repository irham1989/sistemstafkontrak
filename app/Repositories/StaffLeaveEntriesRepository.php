<?php

namespace App\Repositories;

use App\Jobs\StaffLeaveJob;
use App\Models\LeaveCategory;
use App\Models\LeaveRequestStatus;
use App\Models\PublicHoliday;
use App\Models\Staff;
use App\Models\StaffLeaveEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffLeaveEntriesRepository
{
    private StaffPositionRepository $staffPositionRepository;
    public function __construct(StaffPositionRepository $staffPositionRepository)
    {
        $this->staffPositionRepository = $staffPositionRepository;
    }

    public function getStaffLeaveEntry($id){
        return StaffLeaveEntry::with('getStaffPosition', 'getStaffLeave')->where('id', $id)->first();
    }

    public function storeNewRequest(Request $request){
        $staff_id = $request->staff_id;
        $leave_category = $request->leave_category;
        $leave_date_range = $request->leave_date_range;
        $leave_approver = $request->leave_approver;
        $leave_reason = $request->leave_reason;

        $getLeaveCategory = LeaveCategory::find($leave_category);
        $staffPosition = $this->staffPositionRepository->getStaffPosition($staff_id);
        $getBranchState = $staffPosition->getBranch->getState;
        $getWeekend = $getBranchState->getWeekendHoliday;

        $getRangeArr = explode(' to ', $leave_date_range);

        $date = [
            'start' => $getRangeArr[0],
            'end' => $getRangeArr[1] ?? $getRangeArr[0],
        ];

        $yearArr = [
            date('Y', strtotime($date['start'])),
            date('Y', strtotime($date['end']))
        ];

        $getPublic = PublicHoliday::whereIn('year', $yearArr)->where('state_id', $getBranchState->id)->where('h_date', '>=', $date['start'])->where('h_date', '<=', $date['end'])->get();

        $weekendH = [];

        if(count($getWeekend) > 0){
            foreach($getWeekend as $wee){
                $weekendH[] = $wee->getDay->name;
            }
        }

        $publicH = [];
        if(count($getPublic) > 0){
            foreach($getPublic as $p){
                $publicH[] = $p->h_date;
            }
        }

        $hTaken = 0;
        $currentDate = $date['start'];

        while ($currentDate <= $date['end']) {
            $needAdd = true;
            if(in_array(date('l', strtotime($currentDate)), $weekendH)){
                $needAdd = false;
            }

            if(in_array($currentDate, $publicH)){
                $needAdd = false;
            }

            if($needAdd){
                $hTaken++;
            }

            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        if($hTaken == 0){
            return [
                'status' => 'error',
                'message' => 'Tarikh Yang Anda Pilih Adalah Cuti Umum/Cuti Mingguan'
            ];
        }else{
            if($getLeaveCategory->is_half_day == true){
                $hTaken = 0.5 * $hTaken;
            }

            DB::beginTransaction();
            try{
                $m = new StaffLeaveEntry();
                $m->staff_position_id = $staffPosition->id;
                $m->staff_leave_id = $staffPosition->getStaffLeave->id;
                $m->approver_id = $leave_approver;
                $m->leave_category_id = $leave_category;
                $m->start_date = $date['start'];
                $m->end_date = $date['end'];
                $m->days = $hTaken;
                $m->leave_request_status_id = LeaveRequestStatus::PENDING;
                $m->reason = $leave_reason;
                $m->save();

                $sLeave = $staffPosition->getStaffLeave;
                $sLeave->leave_taken = $hTaken;
                $sLeave->leave_balance = $sLeave->leave_balance - $hTaken;
                $sLeave->save();
                dispatch(new StaffLeaveJob($m->id, 'new-request'));
                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();
                return [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

        return [
            'status' => 'success',
            'message' => 'Permohonan Cuti Anda Sedang Menunggu Pengesahan'
        ];
    }

    public function getRequestListByUserId(Request $request){
        $user_id = $request->user_id;
        $approval = $request->approval;

        $search = $request->get('search');
        $searchStr = '';

        if($search){
            $searchStr = 'WHERE b.name LIKE ? OR s.name LIKE ?';
            $params = [
                '%'.$search.'%',
                '%'.$search.'%',
            ];
        }else{
            $params = [
            ];
        }

        $m = DB::select('
            SELECT
            sle.id,
            sle.start_date,
            sle.end_date,
            sle.days,
            sle.leave_request_status_id as status_id,
            sle.reason,
            sle.created_at,
            lrs.name as l_status,
            u.name as approver_name,
            ustaff.name as request_by,
            lc.name as leave_category
            FROM staff_leave_entries sle
            JOIN staff_positions sp ON sp.id = sle.staff_position_id
            JOIN staffs s ON s.id = sp.staff_id
            JOIN staffs sa ON sa.id = sle.approver_id
            JOIN users u ON u.id = sa.user_id
            JOIN users ustaff ON ustaff.id = s.user_id
            '.($approval == true ? 'AND sa.user_id = '.$user_id : 'AND s.user_id = '.$user_id).'
            JOIN leave_request_statuses lrs ON lrs.id = sle.leave_request_status_id
            JOIN leave_categories lc ON lc.id = sle.leave_category_id
            '.$searchStr.'
        ', $params);
//        echo '<pre>';
//        print_r($m);
//        echo '</pre>';
//        die();
        return $m;
    }

    public function deleteRequest(Request $request){
        $id = $request->id;
        DB::beginTransaction();
        try{
            $entry = $this->getStaffLeaveEntry($id);
            $sLeave = $entry->getStaffLeave;
            $sLeave->leave_balance = $sLeave->leave_balance + $entry->days;
            $sLeave->leave_taken = $sLeave->leave_taken - $entry->days;
            $sLeave->save();
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function approveRequest(Request $request){
        $approve_stat = $request->approve_stat;
        $id = $request->id;

        DB::beginTransaction();
        try {
            $m = StaffLeaveEntry::find($id);
            $m->leave_request_status_id = $approve_stat == 1 ? LeaveRequestStatus::APPROVED : LeaveRequestStatus::REJECTED;
            $m->save();

            if($approve_stat == 2){
                $sLeave = $m->getStaffLeave;
                $sLeave->leave_balance = $sLeave->leave_balance + $m->days;
                $sLeave->leave_taken = $sLeave->leave_taken - $m->days;
                $sLeave->save();
            }
            dispatch(new StaffLeaveJob($id, $approve_stat == 1 ? 'approve' : 'reject'));
            DB::commit();
            return [
                'status' => 'success',
                'message' => $approve_stat == 1 ? 'Permohonan Diluluskan' : 'Permohonan Tidak Diluluskan'
            ];
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function getApproverDropdown(Request $request){
        $staff_id = $request->staff_id;
        $branch_id = $request->branch_id;
        $search = $request->search;

        $staff = Staff::select('id', 'user_id')->find($staff_id);
        $user = $staff->getUser;

        $findApproverByRole = null;

        if($user->hasRole('staff')){
            $findApproverByRole = '(5)';
        }elseif($user->hasRole('ketua_unit')){
            $findApproverByRole = '(6, 7)';
        }elseif($user->hasRole('penolong_pengarah')){
            $findApproverByRole = '(7)';
        }

        if($user)
        $m = DB::select('
            SELECT
            s.id,
            u.name,
            sp.branch_position_id,
            ru.role_id
            FROM staffs s
            JOIN users u ON u.id = s.user_id
            JOIN staff_positions sp ON sp.staff_id = s.id
            JOIN branches b ON b.id = sp.branch_id
            JOIN role_user ru ON ru.user_id = u.id
            WHERE b.id = ?
            AND sp.deleted = false
            '.($findApproverByRole != null ? 'AND ru.role_id IN '.$findApproverByRole : '').'
            '.($search ? 'AND u.name LIKE "%'.$search.'%"' : '').'
            LIMIT 10
        ', [
            $branch_id,
        ]);

        $data = [];
        if(count($m) > 0){
            foreach($m as $staff){
                $data[] = [
                    'id' => $staff->id,
                    'text' => strtoupper($staff->name),
                ];
            }
        }

        return $data;
    }
}


