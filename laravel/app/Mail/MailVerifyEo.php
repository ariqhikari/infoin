<?php

namespace App\Mail;

use App\Donation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerifyEo extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $id;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $id)
    {
        $this->user = $user;
        $this->id = $id;
        $this->link = env('DASHBOARD_DOMAIN') . 'verifications/' . $id . '/show';
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
            ->subject('Verifikasi Event Organizer')
            ->view('email.verify-eo');
    }
}
