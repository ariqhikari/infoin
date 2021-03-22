<?php

namespace App\Mail;

use App\Donation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailFullDonation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $donation;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Donation $donation)
    {
        $this->user = $user;
        $this->donation = $donation;
        $this->link = env('DASHBOARD_DOMAIN') . 'donation/details/' . $donation->id;
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
            ->subject('Target Donasi Terpenuhi!')
            ->view('email.full-donation');
    }
}
