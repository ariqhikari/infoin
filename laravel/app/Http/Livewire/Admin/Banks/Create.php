<?php

namespace App\Http\Livewire\Admin\Banks;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Bank;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;

    public function render()
    {
        return view('livewire.admin.banks.create');
    }

    public function store()
    {
        $this->validate([
            "name" => "required|min:3",
            "logo" => "required|mimes:png,jpg,jpeg,svg|max:2048",
        ]);

        $logo = $this->logo->storePublicly('assets/bank', 'public');

        $bank = Bank::create([
            "name" => $this->name,
            "logo" => $logo
        ]);

        $name = $bank->name;
        $this->resetInput();
        $this->emit("storeBank", $name);
    }

    public function resetInput()
    {
        $this->name = null;
        $this->logo = null;
    }
}
