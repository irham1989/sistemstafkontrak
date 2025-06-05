<?php

namespace App\Jobs;

use App\Models\StaffLeaveEntry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class StaffLeaveJob implements ShouldQueue
{
    use Queueable;

    private $staff_leave_entry_id;
    private $type;
    public function __construct($staff_leave_entry_id, $type)
    {
        $this->staff_leave_entry_id = StaffLeaveEntry::find($staff_leave_entry_id);
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $entry = $this->staff_leave_entry_id;
        $user = $entry->getStaffPosition->getStaff->getUser;
        $type = $this->type;

        if(in_array($type, ['approve', 'reject'])){
            Mail::send('mail.staff-request-approval', ['user' => $user, 'approve' => $type == 'approve' ? 1 : 0, 'entry' => $entry], function($message) use ($user, $type){
                $message->to($user->email, $user->name)
                    ->subject($type == 'approve' ? 'Permohonan Cuti Diluluskan' : 'Permohonan Cuti Tidak Diluluskan');
                $message->from('no-reply@ikma.gov.my', 'No-Reply @ IKMa');
            });
        }elseif ($this->type == 'new-request'){
            Mail::send('mail.staff-request-new', ['user' => $user, 'entry' => $entry], function($message) use ($user, $type){
                $message->to($user->email, $user->name)
                    ->subject('Permohonan Cuti Anda Sedang Diproses');
                $message->from('no-reply@ikma.gov.my', 'No-Reply @ IKMa');
            });

            Mail::send('mail.staff-request-new-to-approver', ['user' => $user, 'entry' => $entry], function($message) use ($user, $type, $entry){
                $message->to($entry->getApprover->getUser->email, $entry->getApprover->getUser->name)
                    ->subject('Permohonan Cuti Baru Oleh '.ucwords(strtolower($user->name)));
                $message->from('no-reply@ikma.gov.my', 'No-Reply @ IKMa');
            });
        }
    }
}
