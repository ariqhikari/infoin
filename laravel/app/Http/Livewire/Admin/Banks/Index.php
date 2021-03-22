<?php

namespace App\Http\Livewire\Admin\Banks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Bank;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        "storeBank",
        "storeUpdate",
        "errorUpdate"
    ];

    public $statusUpdate = false;

    public function render()
    {
        $banks = Bank::orderBy("name", "ASC")->paginate(10);
        return view('livewire.admin.banks.index', compact("banks"));
    }

    public function storeBank($name)
    {
        \session()->flash("success", "Berhasil Menambahkan " . $name . " bank");
    }

    public function edit($id)
    {
        $bank = Bank::find($id);
        $this->statusUpdate = true;
        $this->emit("edit", $bank);
    }

    public function delete($id)
    {
        $bank = Bank::find($id);
        \Storage::disk('public')->delete($bank->logo);
        $name = $bank->name;
        $bank->delete();
        \session()->flash("success", "Berhasil menghapus " . $name . " bank");
    }

    public function storeUpdate($name)
    {
        \session()->flash("success", "Berhasil mengubah " . $name . " bank");
        $this->statusUpdate = false;
    }

    public function errorUpdate()
    {
        \session()->flash("error", "Gagal mengubah bank");
        $this->statusUpdate = false;
    }
}
