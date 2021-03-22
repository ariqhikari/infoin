<?php

namespace App\Http\Livewire\Admin\Banks\User;

use Livewire\Component;
use App\UserBank;
use App\User;
use App\Bank;

class Edit extends Component
{
    protected $listeners = [
        "edit"
    ];

    public $userBank_id;
    public $user_id;
    public $bank_id;
    public $no_rekening;
    public $nama_rekening;

    public function render()
    {
        $users = User::all();
        $banks = Bank::all();
        return view('livewire.admin.banks.user.edit', compact('users', 'banks'));
    }

    public function edit($userbank)
    {
        $this->userBank_id = $userbank["id"];
        $this->user_id = $userbank["user_id"];
        $this->bank_id = $userbank["bank_id"];
        $this->no_rekening = $userbank["no_rekening"];
        $this->nama_rekening = $userbank["nama_rekening"];
    }

    public function update()
    {
        $userBank = UserBank::find($this->userBank_id);

        if ($userBank) {
            $userBank->update([
                "user_id" => $this->user_id,
                "bank_id" => $this->bank_id,
                "no_rekening" => $this->no_rekening,
                "nama_rekening" => $this->nama_rekening,
            ]);

            $name = $userBank->user->name;
            $this->resetInput();
            $this->emit("storeUpdate", $name);
        } else {
            $this->resetInput();
            $this->emit("errorUpdate");
        }
    }

    public function resetInput()
    {
        $this->userBank_id = null;
        $this->user_id = null;
        $this->bank_id = null;
        $this->no_rekening = null;
        $this->nama_rekening = null;
    }
}
