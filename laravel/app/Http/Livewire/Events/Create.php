<?php

namespace App\Http\Livewire\Events;

use App\Event;
use App\Jobs\NewEventJob;
use App\Models\Province;
use App\Models\Regency;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Carbon\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $province_id;
    public $regency_id;
    public $alamat;
    public $date_start;
    public $date_end;
    public $desc;
    public $thumbnail;
    public $map;

    public function render()
    {
        $provinces = Province::get();
        $regencies = null;

        if ($this->province_id != null) {
            $regencies = Regency::where('province_id', $this->province_id)->get();
        }

        return view('livewire.events.create', compact("provinces", "regencies"));
    }

    public function store()
    {
        $this->validate([
            "name" => "required|min:5",
            "province_id" => "required",
            "regency_id" => "required",
            "alamat" => "required",
            "date_start" => "required",
            "date_end" => "required",
            "desc" => "required|min:10",
            "thumbnail" => "required|mimes:png,jpg,jpeg,svg",
            "map" => "required|mimes:png,jpg,jpeg,svg"
        ]);

        $fileMap = $this->uploadImage($this->map);
        $fileThumb = $this->uploadImage($this->thumbnail);
        $event = Event::create([
            "name" => $this->name,
            "province_id" => $this->province_id,
            "regency_id" => $this->regency_id,
            "address" => $this->alamat,
            "date_start" => Carbon::parse($this->date_start)->format('Y-m-d\TH:i'),
            "date_end" => Carbon::parse($this->date_end)->format('Y-m-d\TH:i'),
            "desc" => $this->desc,
            "slug" => \Str::slug($this->name . " " . \Str::random(5)),
            "user_id" => Auth::id(),
            "maps" => $fileMap,
            "thumbnail" => $fileThumb
        ]);

        NewEventJob::dispatch($event, $this->regency_id)->delay(now()->addSeconds(5));

        $this->resetInput();

        return redirect()->route("event.index");
    }

    public function resetInput()
    {
        $this->name = null;
        $this->province_id = null;
        $this->regency_id = null;
        $this->alamat = null;
        $this->date_start = null;
        $this->date_end = null;
        $this->desc = null;
        $this->thumbnail = null;
        $this->map = null;
    }

    public function uploadImage($fileParam)
    {
        return $fileParam->storePublicly('assets/event', 'public');
    }
}
