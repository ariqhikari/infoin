<?php

namespace App\Mail;

use App\Donation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailThanksDonation extends Mailable
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
    public function __construct(User $user, $donation_id)
    {
        $this->user = $user;
        $this->donation = Donation::findOrFail($donation_id);
        $this->link = env('DASHBOARD_DOMAIN') . 'donation/transaction';
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
            ->subject('Terimakasih telah membantu!')
            ->view('email.thanks-donation');
    }
}
