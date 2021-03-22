<?php

namespace App\Http\Livewire\Admin\Donation;

use App\Donation;
use Livewire\Component;
use Livewire\WithPagination;
use App\DonationDetail;

class Detail extends Component
{
    use withPagination;
    public $search;
    public $idDonationDetail;
    public $statusDelete = false;
    public $paginate = 10;
    public $donationDetail;

    public function mount($donationDetail)
    {
        $this->donationDetail = $donationDetail;
    }

    public function render()
    {
        $title = Donation::findOrFail($this->donationDetail)->title;

        if ($this->search == null) {
            $donationDetails = DonationDetail::where('donation_id', $this->donationDetail)->with(['donation', 'user'])->orderBy("created_at", "DESC")->paginate($this->paginate);
        } else {
            $donationDetails = DonationDetail::where('donation_id', $this->donationDetail)->whereHas('user', function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%');
            })->latest()->paginate($this->paginate);
        }
        return view('livewire.admin.donation.detail', compact("donationDetails", "title"));
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
