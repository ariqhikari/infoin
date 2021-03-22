<?php

namespace App\Http\Livewire\Chats;

use Livewire\Component;
use App\User;
use Auth;

class Contacts extends Component
{
    public function render()
    {
        $contacts;
        if (Auth::user()->role_id == 3) {
            $contacts = User::where("role_id","!=",3)->orderBy("name","ASC")->get();
        } else{
            $contacts = User::where("role_id",3)->orderBy("name","ASC")->get();
        }

        return view('livewire.chats.contacts',compact("contacts"));
    }

    public function chooseContact($id){
        $contact = User::find($id);
        $this->emit("setContact", $contact);
    }
}
