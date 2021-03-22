<?php

namespace App\Mail;

use App\Donation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerifyEoAccept extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->link = env('DASHBOARD_DOMAIN');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('info@info.in', 'Info.In')
            ->subject('Verifikasi Event Organizer Telah Disetujui!')
            ->view('email.verify-eo-accept');
    }
}
