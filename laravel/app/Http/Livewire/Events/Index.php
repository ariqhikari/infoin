<?php

namespace App\Http\Livewire\Events;

use Auth;
use App\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        "batalEdit",
        "successEdit"
    ];

    public $filter = 3;
    public $search;
    public $statusEdit = false;

    public function render()
    {
        switch ($this->filter) {
            case 0:
                if ($this->search != null) {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where([
                            ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->where([
                            ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                } else {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where([
                            ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("user_id", Auth::id())->where([
                            ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                }
                break;
            case 1:
                if ($this->search != null) {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where([
                            ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->where([
                            ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                } else {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where([
                            ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("user_id", Auth::id())->where([
                            ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                }
                break;
            case 2:
                if ($this->search != null) {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where([
                            ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->where([
                            ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                } else {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where([
                            ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    } else {
                        $events = Event::where("user_id", Auth::id())->where([
                            ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                            ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
                        ])->get();
                    }
                }
                break;
            case 3:
                if ($this->search != null) {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->get();
                    } else {
                        $events = Event::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->get();
                    }
                } else {
                    if (Auth::user()->role_id == 3) {
                        $events = Event::get();
                    } else {
                        $events = Event::where("user_id", Auth::id())->get();
                    }
                }
                break;
        }

        if (Auth::user()->role_id == 3) {
            $expired = Event::where([
                ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $started = Event::where([
                ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $notStart = Event::where([
                ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $all = Event::get();
        } else {
            $expired = Event::where("user_id", Auth::id())->where([
                ["date_start", "<", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", "<", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $started = Event::where("user_id", Auth::id())->where([
                ["date_start", "<=", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", ">=", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $notStart = Event::where("user_id", Auth::id())->where([
                ["date_start", ">", Carbon::now()->format('Y-m-d\TH:i')],
                ["date_end", ">", Carbon::now()->format('Y-m-d\TH:i')],
            ])->get();
            $all = Event::where("user_id", Auth::id())->get();
        }

        return view('livewire.events.index', compact("events", "started", "notStart", "expired", "all"));
    }

    public function filter($id)
    {
        $this->filter = $id;
    }

    public function delete($id)
    {
        $event = Event::find($id);

        if ($event->thumbnail != null) {
            \Storage::disk('public')->delete($event->thumbnail);
        }

        \Storage::disk('public')->delete($event->maps);

        $event->delete();
    }

    public function edit($id)
    {
        $event = Event::find($id);
        $this->statusEdit = true;
        $this->emit("edit", $event);
    }

    public function batalEdit()
    {
        $this->statusEdit = false;
    }

    public function successEdit()
    {
        $this->statusEdit = false;
    }
}
