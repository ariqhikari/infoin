<?php

namespace App\Http\Livewire\Verification;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use App\Eo_Verification;

class Store extends Component
{
    use WithFileUploads;

    public $ktp;

    public function render()
    {
        return view('livewire.verification.store');
    }

    public function store()
    {
        $this->validate([
            "ktp" => "required|mimes:png,jpg,jpeg"
        ]);

        $file = $this->ktp;
        $name_file = $file->getClientOriginalName();

        $name_split = \explode(".", $name_file);
        $name_split[0] = \uniqid();

        $name_file_upload = "";
        $name_file_upload .= $name_split[0];
        $name_file_upload .= ".";
        $name_file_upload .= $name_split[1];

        \Storage::putFileAs("public/assets/ktp", $file, $name_file_upload);

        Eo_Verification::create([
            "user_id" => Auth::id(),
            "ktp" => "storage/assets/ktp/" . $name_file_upload,
        ]);

        return redirect()->route("profile.edit")->with("success", "Berhasil mengirimkan verifikasi ke admin, tunggu respon dari admin");
    }
}
