<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class OnlineList extends Component
{
    use WithPagination;
    
    public function render()
    {
        $onlines = User::where("status",1)->orderBy("name","ASC")->paginate(5);
        return view('livewire.online-list',compact("onlines"));
    }
}
