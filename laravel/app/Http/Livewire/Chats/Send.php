<?php

namespace App\Http\Livewire\Chats;

use Livewire\Component;
use Auth;
use App\Chat;
use App\User;

class Send extends Component
{
    protected $listeners = [
        "setContact"
    ];
    public $contact = null;
    public $message;

    public function render()
    {
        $chats = Chat::get();
        $chatMe = [];

        if ($this->contact != null) {
            foreach ($chats as $key => $value) {
                if ($value->sender_id == Auth::id() || $value->receiver_id == Auth::id()) {
                    if ($value->sender_id == $this->contact["id"] || $value->receiver_id == $this->contact["id"]) {
                        $chatMe[] = $value;
                    }
                }
            }

            foreach ($chats as $key => $value) {
                if($value->sender_id == $this->contact["id"] && $value->receiver_id == Auth::id()){
                    if ($value->status == 0) {
                        $value->update([
                            "status" => 1
                        ]);
                    }
                }
            }
        }

        return view('livewire.chats.send',compact("chatMe"));
    }

    public function setContact($contact){
        $this->contact = $contact;
    }

    public function storeMessage(){
        $chat = Chat::create([
            "receiver_id" => $this->contact["id"],
            "sender_id" => Auth::id(),
            "message" => \Crypt::encrypt($this->message),
            "status" => 0
        ]);

        $this->message = null;
    }
}
