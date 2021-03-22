<?php

namespace App\Http\Livewire\Admin\Banks\User;

use Livewire\Component;
use App\UserBank;
use App\User;
use App\Bank;

class Create extends Component
{
    public $user_id;
    public $bank_id;
    public $no_rekening;
    public $nama_rekening;

    public function render()
    {
        $users = User::all();
        $banks = Bank::all();
        if (\Auth::user()->role_id != 3) {
            $this->user_id = \Auth::user()->id;
        }
        return view('livewire.admin.banks.user.create', compact('users', 'banks'));
    }

    public function store()
    {
        $this->validate([
            "user_id" => "required|exists:users,id",
            "bank_id" => "required|exists:banks,id",
            "no_rekening" => "required|min:3",
            "nama_rekening" => "required",
        ]);

        $userBank = UserBank::create([
            "user_id" => $this->user_id,
            "bank_id" => $this->bank_id,
            "no_rekening" => $this->no_rekening,
            "nama_rekening" => $this->nama_rekening,
        ]);

        $name = $userBank->user->name;
        $this->resetInput();
        $this->emit("storeUserBank", $name);
    }

    public function resetInput()
    {
        $this->user_id = null;
        $this->bank_id = null;
        $this->no_rekening = null;
        $this->nama_rekening = null;
    }
}
