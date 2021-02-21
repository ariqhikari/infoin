<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Eo_Verification;
use Livewire\WithPagination;

class VerificationList extends Component
{
    use WithPagination;

    public function render()
    {
        $data = Eo_Verification::latest()->paginate(10);
        return view('livewire.admin.verification-list',compact("data"));
    }
}
