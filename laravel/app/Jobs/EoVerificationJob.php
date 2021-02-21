<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Mail;
use App\Mail\MailVerifyEo;
use App\User;

class EoVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $verify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $verify)
    {
        $this->user = $user;
        $this->verify = $verify;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::where('role_id', 3)->get();

        foreach ($users as $user) {
            Mail::to($user)->send(new MailVerifyEo($this->user, $this->verify->id));
        }
    }
}
