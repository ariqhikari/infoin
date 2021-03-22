<?php

namespace App\Http\Livewire\Admin\Donation;

use Livewire\Component;
use Livewire\WithPagination;
use App\DonationDetail;

class Transaction extends Component
{
    use withPagination;
    public $search;
    public $idDonationDetail;
    public $statusDelete = false;
    public $paginate = 10;

    public function render()
    {
        if ($this->search == null) {
            if (\Auth::user()->role_id != 3) {
                $donationDetails = DonationDetail::where('user_id', \Auth::user()->id)->with(['donation', 'user'])->orderBy("created_at", "DESC")->paginate($this->paginate);
            } else {
                $donationDetails = DonationDetail::with(['donation', 'user'])->orderBy("created_at", "DESC")->paginate($this->paginate);
            }
        } else {
            if (\Auth::user()->role_id != 3) {
                $donationDetails = DonationDetail::where('user_id', \Auth::user()->id)->whereHas('donation', function ($query) {
                    return $query->where('title', 'LIKE', '%' . $this->search . '%');
                })->latest()->paginate($this->paginate);
            } else {
                $donationDetails = DonationDetail::whereHas('donation', function ($query) {
                    return $query->where('title', 'LIKE', '%' . $this->search . '%');
                })->latest()->paginate($this->paginate);
            }
        }
        return view('livewire.admin.donation.transaction.index', compact("donationDetails"));
    }

    public function delete($id)
    {
        $this->idDonationDetail = $id;
        $this->statusDelete = true;
    }

    public function cancel()
    {
        $this->statusDelete = false;
        \session()->flash("error", "Tidak Melanjutkan Penghapusan");
    }

    public function destroy()
    {
        $donationdetail = DonationDetail::find($this->idDonationDetail);

        \Storage::disk('public')->delete($donationdetail->bukti_pembayaran);
        $donationdetail->delete();
        $this->statusDelete = false;
        \session()->flash("success", "Berhasil Melakukan Penghapusan");
    }
}
