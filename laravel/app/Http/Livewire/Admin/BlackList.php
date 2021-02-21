<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use Illuminate\Support\Str;

class BlackList extends Component
{
    use withPagination;
    public $search;
    public $idUser;
    public $statusDelete = false;
    public $statusBlacklist = false;
    public $paginate = 10;

    public function render()
    {
        if ($this->search == null) {
            $users = User::orderBy("name", "ASC")->where([
                ["blacklist", '=', 1],
            ])->latest()->paginate($this->paginate);
        } else {
            $users = User::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where([
                ["blacklist", '=', 1],
            ])->latest()->paginate($this->paginate);
        }
        return view('livewire.admin.black-list', compact("users"));
    }

    public function delete($id)
    {
        $this->idUser = $id;
        $this->statusDelete = true;
    }

    public function cancel()
    {
        $this->statusDelete = false;
        \session()->flash("error", "Tidak Melanjutkan Penhapusan");
    }

    public function destroy()
    {
        $user = User::find($this->idUser);

        if (!Str::contains($user->avatar, 'avatar')) {
            \Storage::disk('public')->delete($user->avatar);
        }

        foreach ($user->recentLogin as $key => $value) {
            $value->delete();
        }
        $user->delete();
        $this->statusDelete = false;
        \session()->flash("success", "Berhasil Melakukan Penghapusan");
    }

    public function restoreBlacklist($id)
    {
        $this->idUser = $id;
        $this->statusBlacklist = true;
    }

    public function cancelBlacklist()
    {
        $this->statusBlacklist = false;
        \session()->flash("error", "Tidak Melanjutkan Restore");
    }

    public function updateBlacklist()
    {
        $user = User::find($this->idUser);

        foreach ($user->articles as $key => $value) {
            $value->update([
                'status_id' => 2
            ]);
        }

        foreach ($user->donations as $key => $value) {
            $value->update([
                'status_id' => 2
            ]);
        }

        $user->update([
            'blacklist' => 0
        ]);

        $this->statusBlacklist = false;
        \session()->flash("success", "Berhasil Melakukan Restore");
    }
}
