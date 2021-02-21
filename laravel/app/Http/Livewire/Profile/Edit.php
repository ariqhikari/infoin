<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\User;
use Auth;

class Edit extends Component
{
    public $user;
    public function render()
    {
        $this->user = User::find(Auth::id());
        return view('livewire.profile.edit');
    }

    public function update($id){
        $user = User::find($id);
        $this->emit("update",$user);
    }
}
