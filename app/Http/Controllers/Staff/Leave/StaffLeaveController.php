<?php

namespace App\Http\Controllers\Staff\Leave;

use App\Http\Controllers\Controller;
use App\Library\Datatable\SymTable;
use App\Models\StaffLeaveEntry;
use App\Models\User;
use App\Repositories\StaffLeaveEntriesRepository;
use App\Repositories\StaffRepository;
use App\Traits\CommonTrait;
use App\Traits\LookupTrait;
use Illuminate\Http\Request;

class StaffLeaveController extends Controller
{
    use CommonTrait, LookupTrait;
    private StaffRepository $staffRepository;
    private StaffLeaveEntriesRepository $staffLeaveEntriesRepository;

    public function __construct(StaffRepository $staffRepository, StaffLeaveEntriesRepository $staffLeaveEntriesRepository){
        $this->staffRepository = $staffRepository;
        $this->staffLeaveEntriesRepository = $staffLeaveEntriesRepository;
    }

    public function leaveNewRequest($user_id){
        $staff = $this->staffRepository->getStaffProfile($user_id);
        $leaveCategory = $this->getLeaveCategories();
        return view('staff.leave.new-request', [
            'staff' => $staff,
            'leaveCategory' => $leaveCategory
        ]);
    }

    public function storeUpdateNewRequest(Request $request){
        $m = $this->staffLeaveEntriesRepository->storeNewRequest($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function leaveRequest($user_id){
        $user = User::find($user_id);
        $is_role = [
            'superadmin' => $user->hasRole('super-admin'),
            'admin' => $user->hasRole('admin'),
            'approvaladmin' => $user->hasRole('approval-admin'),
            'staff' => $user->hasRole('staff'),
        ];

        return view('staff.leave.request', [
            'user_id' => $user_id,
            'is_role' => $is_role
        ]);
    }

    public function requestList(Request $request){
        $entries = $this->staffLeaveEntriesRepository->getRequestListByUserId($request);

        return SymTable::of($entries)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('dates', function($data){
                return $this->regularDate($data->start_date).'<br> Hingga <br> '.$this->regularDate($data->end_date).'<br><br><b class="text-success">'.$this->regularDate($data->created_at).'<b></b>';
            })->addColumn('days', function($data){
                return $data->days.' HARI';
            })->addColumn('status', function($data){
                return strtoupper($data->l_status);
            })->addColumn('approver_name', function($data){
                return strtoupper($data->approver_name);
            })->addColumn('reason', function($data){
                return $data->reason ? strtoupper($data->reason) : '-';
            })->make();
    }

    public function requestDelete(Request $request){
       $m = $this->staffLeaveEntriesRepository->deleteRequest($request);

       if($m){
           return $this->setResponse($this->setHardDelete(StaffLeaveEntry::class, $request->id, 'Permohonan'));
       }else{
           return $this->setResponse('WHOOPS', false);
       }
    }

    public function requestApproval(Request $request){
        $m = $this->staffLeaveEntriesRepository->approveRequest($request);
        return $this->setResponse($m['message'], !($m['status'] == 'error'));
    }

    public function getApprover(Request $request){
        return json_encode(['items' => $this->staffLeaveEntriesRepository->getApproverDropdown($request)]);
    }

    public function leaveApproval($user_id){
        $user = User::find($user_id);
        $is_role = [
            'superadmin' => $user->hasRole('super-admin'),
            'admin' => $user->hasRole('admin'),
            'approvaladmin' => $user->hasRole('approval-admin'),
            'staff' => $user->hasRole('staff'),
        ];

        return view('staff.leave.approval', [
            'user_id' => $user_id,
            'is_role' => $is_role
        ]);
    }

    public function approvalList(Request $request){
        $request->request->add(['approval' => true]);
        $entries = $this->staffLeaveEntriesRepository->getRequestListByUserId($request);

        return SymTable::of($entries)
            ->addRowAttr([
                'data-id' => function($data){
                    return $data->id;
                }
            ])
            ->addColumn('name', function($data){
                return strtoupper($data->request_by).'<br> <b class="text-success">'.$this->regularDate($data->created_at).'<b>';
            })->addColumn('h_date', function($data){
                return $this->regularDate($data->start_date).' <br>Hingga<br> '.$this->regularDate($data->end_date);
            })->addColumn('days', function($data){
                return $data->days.' HARI';
            })->addColumn('status', function($data){
                return strtoupper($data->l_status);
            })->addColumn('approver_name', function($data){
                return strtoupper($data->approver_name);
            })->addColumn('reason', function($data){
                return '<b class="text-primary text-decoration-underline">'.ucwords($data->leave_category).'</b><br>'.($data->reason ? strtoupper($data->reason) : '-');
            })->make();
    }
}
