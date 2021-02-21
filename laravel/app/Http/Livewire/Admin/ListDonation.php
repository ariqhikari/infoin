<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Donation;

class ListDonation extends Component
{
    use WithPagination;

    public function render()
    {
        if (\Auth::user()->role_id == 3) {
            $donations = Donation::where([
                ['status_id', '=', 1],
            ])->with(['donation_details', 'user'])->latest()->paginate(5);
        } else {
            $donations = Donation::where([
                ['user_id', '=', \Auth::user()->id],
                ['status_id', '=', 1],
            ])->with(['donation_details', 'user'])->latest()->paginate(5);
        }
        return view('livewire.admin.list-donation', compact("donations"));
    }
}
