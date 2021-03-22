<?php

namespace App\Http\Livewire\Admin\Banks;

use Livewire\Component;

use App\Bank;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    protected $listeners = [
        "edit"
    ];

    public $name;
    public $logo;
    public $bankId;

    public function render()
    {
        return view('livewire.admin.banks.edit');
    }

    public function edit($bank)
    {
        $this->name = $bank["name"];
        $this->logo = $bank["logo"];
        $this->bankId = $bank["id"];
    }

    public function update()
    {
        $bank = Bank::find($this->bankId);

        if ($bank) {
            $bank->update([
                "name" => $this->name,
            ]);

            if ($this->logo) {
                \Storage::disk('public')->delete($bank->logo);
                $logo = $this->logo->storePublicly('assets/bank', 'public');

                $bank->update(["logo" => $logo]);
            }

            $name = $this->name;
            $this->resetInput();
            $this->emit("storeUpdate", $name);
        } else {
            $this->resetInput();
            $this->emit("errorUpdate");
        }
    }

    public function resetInput()
    {
        $this->name = null;
        $this->logo = null;
        $this->bankId = null;
    }
}
