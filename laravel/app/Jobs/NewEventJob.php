<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

use Mail;
use App\Mail\MailNewEvent;
use App\Models\Regency;
use App\Visitor;
use Carbon\Carbon;

class NewEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    protected $regency_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event, $regency_id)
    {
        $this->event = $event;
        $this->regency_id = $regency_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $eventCity = Regency::where('id', $this->regency_id)->first();
        $eventCity = Str::lower($eventCity->name);
        $visitors = Visitor::latest();

        foreach ($visitors as $index => $visitor) {
            $userLocation = \Location::get($visitor->ip);
            $userLocation = ($userLocation) ? Str::lower($userLocation->cityName) : null;

            $visitorBefore = ($index == 0) ? null : ($visitors[$index - 1]->user_id);

            if (Str::contains($eventCity, $userLocation) && $visitor->user_id != $visitorBefore) {
                $this->event->date_start = Carbon::parse($this->date_start)->format('d M Y H:i');
                $this->event->date_end = Carbon::parse($this->date_end)->format('d M Y H:i');
                Mail::to($visitor->user)->send(new MailNewEvent($visitor->user, $this->event));
            }
        }
    }
}
