<?php

namespace App\Http\Livewire\Events;

use App\Event;
use App\Models\Province;
use App\Models\Regency;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Carbon\Carbon;

class Edit extends Component
{

    use WithFileUploads;

    protected $listeners = [
        "edit"
    ];

    public $name;
    public $province_id;
    public $regency_id;
    public $alamat;
    public $date_start;
    public $date_end;
    public $desc;
    public $thumbnail;
    public $map;
    public $idEvent;
    public $eventThumb;
    public $eventMap;

    public function render()
    {
        $provinces = Province::get();
        $regencies = null;

        if ($this->province_id != null) {
            $regencies = Regency::where('province_id', $this->province_id)->get();
        }

        return view('livewire.events.edit', compact("provinces", "regencies"));
    }

    public function batal()
    {
        $this->resetInput();
        $this->emit("batalEdit");
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
        $this->idEvent = null;
        $this->event = null;
        $this->eventMap = null;
        $this->eventThumb = null;
    }

    public function edit($event)
    {
        $this->name = $event["name"];
        $this->province_id = $event["province_id"];
        $this->regency_id = $event["regency_id"];
        $this->alamat = $event["address"];
        $this->date_start = $event["date_start"];
        $this->date_end = $event["date_end"];
        $this->desc = $event["desc"];
        $this->idEvent = $event["id"];
        $this->eventThumb = $event["thumbnail"];
        $this->eventMap = $event["maps"];
    }

    public function update()
    {
        $this->validate([
            "name" => "required|min:5",
            "province_id" => "required",
            "regency_id" => "required",
            "alamat" => "required",
            "date_start" => "required",
            "date_end" => "required",
            "desc" => "required|min:10",
            "thumbnail" => "nullable|mimes:png,jpg,jpeg,svg",
            "map" => "nullable|mimes:png,jpg,jpeg,svg"
        ]);

        $event = Event::find($this->idEvent);

        if ($this->map == null && $this->thumbnail == null) {
            $event->update([
                "name" => $this->name,
                "province_id" => $this->province_id,
                "regency_id" => $this->regency_id,
                "address" => $this->alamat,
                "date_start" => Carbon::parse($this->date_start)->format('Y-m-d\TH:i'),
                "date_end" => Carbon::parse($this->date_end)->format('Y-m-d\TH:i'),
                "desc" => $this->desc,
                "slug" => \Str::slug($this->name . " " . \Str::random(5)),
            ]);
        } else if ($this->map == null) {
            $status = $this->uploadImage($this->thumbnail, $event, 0);
            $event->update([
                "name" => $this->name,
                "province_id" => $this->province_id,
                "regency_id" => $this->regency_id,
                "address" => $this->alamat,
                "date_start" => Carbon::parse($this->date_start)->format('Y-m-d\TH:i'),
                "date_end" => Carbon::parse($this->date_end)->format('Y-m-d\TH:i'),
                "desc" => $this->desc,
                "slug" => \Str::slug($this->name . " " . \Str::random(5)),
                "thumbnail" => $status
            ]);
        } else if ($this->thumbnail == null) {
            $status = $this->uploadImage($this->map, $event, 0);
            $event->update([
                "name" => $this->name,
                "province_id" => $this->province_id,
                "regency_id" => $this->regency_id,
                "address" => $this->alamat,
                "date_start" => Carbon::parse($this->date_start)->format('Y-m-d\TH:i'),
                "date_end" => Carbon::parse($this->date_end)->format('Y-m-d\TH:i'),
                "desc" => $this->desc,
                "slug" => \Str::slug($this->name . " " . \Str::random(5)),
                "maps" => $status
            ]);
        } else {
            $status1 = $this->uploadImage($this->map, $event, 1);
            $status2 = $this->uploadImage($this->thumbnail, $event, 2);
            $event->update([
                "name" => $this->name,
                "province_id" => $this->province_id,
                "regency_id" => $this->regency_id,
                "address" => $this->alamat,
                "date_start" => Carbon::parse($this->date_start)->format('Y-m-d\TH:i'),
                "date_end" => Carbon::parse($this->date_end)->format('Y-m-d\TH:i'),
                "desc" => $this->desc,
                "slug" => \Str::slug($this->name . " " . \Str::random(5)),
                "maps" => $status1,
                "thumbnail" => $status2
            ]);
        }

        $this->resetInput();
        $this->emit("successEdit");
    }

    public function uploadImage($fileParam, $event, $param)
    {
        $file = $fileParam;
        $name_file = $file->getClientOriginalName();

        $name_split = \explode(".", $name_file);
        $name_split[0] = \uniqid();

        $name_upload = "";
        $name_upload .= $name_split[0];
        $name_upload .= ".";
        $name_upload .= $name_split[1];

        if ($this->map == null) {
            $thumbEvent = explode("/", $event->thumbnail);
        } else if ($this->thumbnail == null) {
            $thumbEvent = explode("/", $event->maps);
        } else {
            if ($param == 1) {
                $thumbEvent = explode("/", $event->maps);
            } else {
                $thumbEvent = explode("/", $event->thumbnail);
            }
        }

        $folderFile = \Storage::allFiles("public/assets/event");
        foreach ($folderFile as $key => $value) {
            $fileFolder = explode("/", $value);
            if ($fileFolder[3] == $thumbEvent[3]) {
                \Storage::disk("local")->delete($value);
            }
        }

        \Storage::putFileAs("public/assets/event", $file, $name_upload);

        return "assets/event/" . $name_upload;
    }
}
