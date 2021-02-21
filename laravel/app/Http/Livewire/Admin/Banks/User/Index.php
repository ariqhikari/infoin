<?php

namespace App\Http\Livewire\Admin\Banks\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\UserBank;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        "storeUserBank",
        "storeUpdate",
        "errorUpdate"
    ];

    public $statusUpdate = false;

    public function render()
    {
        if (\Auth::user()->role_id == 3) {
            $userBanks = UserBank::orderBy("user_id", "ASC")->paginate(10);
        } else {
            $userBanks = UserBank::where('user_id', \Auth::user()->role_id)->orderBy("user_id", "ASC")->paginate(10);
        }
        return view('livewire.admin.banks.user.index', compact("userBanks"));
    }

    public function storeUserBank($name)
    {
        \session()->flash("success", "Berhasil Menambahkan " . $name . " bank");
    }

    public function edit($id)
    {
        $user = UserBank::find($id);
        $this->statusUpdate = true;
        $this->emit("edit", $user);
    }

    public function delete($id)
    {
        $user = UserBank::find($id);
        $name = $user->user->name;
        $user->delete();
        \session()->flash("success", "Berhasil menghapus " . $name . " bank");
    }

    public function storeUpdate($name)
    {
        \session()->flash("success", "Berhasil mengubah " . $name . " bank");
        $this->statusUpdate = false;
    }

    public function errorUpdate()
    {
        \session()->flash("error", "Gagal mengubah user bank");
        $this->statusUpdate = false;
    }
}
