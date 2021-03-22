<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class AdminList extends Component
{
    use withPagination;
    public $search;
    public $idUser;
    public $statusDelete = false;
    public $paginate = 10;

    public function render()
    {
        if ($this->search == null) {
            $users = User::orderBy("name", "ASC")->where("role_id", 3)->latest()->paginate($this->paginate);
        } else {
            $users = User::where("name", $this->search)->orWhere("name", "like", "%" . $this->search . "%")->where("role_id", 3)->latest()->paginate($this->paginate);
        }
        return view('livewire.admin.admin-list', compact("users"));
    }
}
