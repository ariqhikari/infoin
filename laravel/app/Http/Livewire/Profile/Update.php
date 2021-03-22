<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Http\Controllers\Dashboard\EditProfile;
use Livewire\WithFileUploads;
use App\User;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $slug;
    public $avatar;
    public $password;

    public function mount($user)
    {
        $this->name = $user["name"];
        $this->email = $user["email"];
        $this->phone = $user["phone"];
        $this->slug = $user["slug"];
    }

    public function render()
    {
        return view('livewire.profile.update');
    }

    public function storeUpdate()
    {
        $this->validate([
            "name" => "required|min:3",
        ]);

        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "avatar" => $this->avatar,
            "password" => $this->password
        ];
        $user = User::where("slug", $this->slug)->first();

        $edit = new EditProfile();
        $status = $edit->storeDataUpdate($data, $user);
        if ($status == true) {
            $this->emit("handleUpdate", $status);
        } else {
            $this->emit("handleUpdate", $status);
        }
    }

    public function cancel()
    {
        $this->emit("cancel");
    }
}
