<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Index extends Component
{
    public $statusEdit = false;
    public $user;
    protected $listeners = [
        "update",
        "handleUpdate",
        "cancel",
    ];

    public function render()
    {
        return view('livewire.profile.index');
    }
    
    public function update($user){
        $this->statusEdit = true;
        $this->user = $user;
    }

    public function handleUpdate($status){
        if ($status == true) {
            \session()->flash("success","Berhasil Mengedit Profile");
        } else {
            \session()->flash("error","Gagal Mengedit Profile, Periksa Kembali Gambar Yang Dikirim");
        }
        $this->statusEdit = false;
    }

    public function cancel(){
        $this->statusEdit = false;
    }
}
