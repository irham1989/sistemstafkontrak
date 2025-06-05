<?php

namespace App\Jobs;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserJob implements ShouldQueue
{
    use Queueable;

    private $type;
    private $user_id;

    private $password;

    public $adminArrEmail = [
        'akiyamasensei555@gmail.com'
    ];

    /**
     * Create a new job instance.
     */

    public function __construct($user_id, $type, $password = false)
    {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(UserRepository $userRepository): void
    {
        $user = $userRepository->getUser($this->user_id);

        if($this->type == 'admin_add_new_user'){
            //To Lead
            Mail::send('mail.admin_add_new_user', ['user' => $user, 'password' => $this->password], function($message) use ($user){
                $message->to($user->email, $user->name)
                    ->subject('Anda Telah Didaftarkan Ke Dalam Sistem Pengurusan Staff Kontrak IKMa');
                $message->from('no-reply@ikma.gov.my', 'No-Reply @ IKMa');
            });
        }
    }
}
