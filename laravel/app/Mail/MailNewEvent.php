<?php

namespace App\Mail;

use App\Donation;
use App\Event;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNewEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $event;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Event $event)
    {
        $this->user = $user;
        $this->event = $event;
        $this->link = env('MAIN_DOMAIN') . 'event/' . $event->slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = $this->event;

        return $this
            ->from('info@info.in', 'Info.In')
            ->subject("$event->title")
            ->view('email.event');
    }
}
