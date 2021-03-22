<?php

namespace App\Http\Livewire\Admin\Donation;

use Livewire\Component;
use App\Donation;
use Livewire\WithPagination;
use App\Status;
use App\Categori;
use App\CategoriDonation;
use Auth;

class Index extends Component
{
    use WithPagination;
    public $active = null;
    public $search;
    public $donationEdit;
    public $categories;

    public function mount($donationEdit, $categories)
    {
        $this->donationEdit = $donationEdit;
        $this->categories = $categories;
    }

    public function render()
    {
        if ($this->search != null) {
            if ($this->active == null) {
                if (Auth::user()->role_id != 3) {
                    $donations = Donation::where('user_id', Auth::user()->id)->withTrashed()->with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->latest()->paginate(10);
                } else {
                    $donations = Donation::withTrashed()->with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->latest()->paginate(10);
                }
            } else {
                if ($this->active == 1) {
                    $donations = $this->getSearch(1);
                } else if ($this->active == 2) {
                    $donations = $this->getSearch(2);
                } else if ($this->active == 3) {
                    $donations = $this->getSearchTrash();
                }
            }
        } else {
            if ($this->active == null) {
                if (Auth::user()->role_id != 3) {
                    $donations = Donation::withTrashed()->with('donation_details')->where("user_id", Auth::id())->latest()->paginate(10);
                } else {
                    $donations = Donation::withTrashed()->with('donation_details')->latest()->paginate(10);
                }
            } else {
                if ($this->active == 1) {
                    $donations = $this->getData(1);
                } else if ($this->active == 2) {
                    $donations = $this->getData(2);
                } else if ($this->active == 3) {
                    $donations = $this->getDataTrash();
                }
            }
        }

        if (Auth::user()->role_id != 3) {
            $all = Donation::withTrashed()->with('donation_details')->where("user_id", Auth::id())->get();
            $trash = Donation::onlyTrashed()->with('donation_details')->where("user_id", Auth::id())->count();
        } else {
            $all = Donation::withTrashed()->with('donation_details')->get();
            $trash = Donation::onlyTrashed()->with('donation_details')->count();
        }
        $status = Status::get();
        $categori = Categori::get();
        $draft = $this->getCount(2);
        $publish = $this->getCount(1);
        return view('livewire.admin.donation.index', compact("donations", "status", "categori", "draft", "trash", "publish", "all"));
    }

    public function getData($active)
    {
        if (Auth::user()->role_id != 3) {
            $donations = Donation::where("user_id", Auth::id())->with('donation_details')->where("status_id", $active)->latest()->paginate(10);
        } else {
            $donations = Donation::with('donation_details')->where("status_id", $active)->latest()->paginate(10);
        }
        return $donations;
    }

    public function getSearch($active)
    {
        if (Auth::user()->role_id != 3) {
            $donations = Donation::with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->where("status_id", $active)->latest()->paginate(10);
        } else {
            $donations = Donation::with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("status_id", $active)->latest()->paginate(10);
        }
        return $donations;
    }

    public function getSearchTrash()
    {
        if (Auth::user()->role_id != 3) {
            $donations = Donation::onlyTrashed()->with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->latest()->paginate(10);
        } else {
            $donations = Donation::onlyTrashed()->with('donation_details')->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->latest()->paginate(10);
        }
        return $donations;
    }

    public function getCount($status)
    {
        if (Auth::user()->role_id != 3) {
            return Donation::where("user_id", Auth::id())->with('donation_details')->where("status_id", $status)->get()->count();
        } else {
            return Donation::with('donation_details')->where("status_id", $status)->get()->count();
        }
    }

    public function active($number)
    {
        $this->active = $number;
    }

    public function nonActive()
    {
        $this->active = null;
    }

    public function toTrash($id)
    {
        $donation = Donation::find($id);
        $donation->update([
            "status_id" => 3
        ]);
        $donation->delete();
        \session()->flash("successDonation", "Berhasil memindahkan donation ke tempat sampah");
    }

    public function restore($id)
    {
        $donation = Donation::onlyTrashed()->find($id);
        $donation->update([
            "status_id" => 2
        ]);
        $donation->restore();
        \session()->flash("successDonation", "Berhasil memulihkan donation");
    }

    public function getDataTrash()
    {
        if (Auth::user()->role_id != 3) {
            $donation = Donation::onlyTrashed()->where("user_id", Auth::id())->latest()->paginate(10);
        } else {
            $donation = Donation::onlyTrashed()->latest()->paginate(10);
        }
        return $donation;
    }

    public function destroy($id)
    {
        $donation = Donation::onlyTrashed()->find($id);

        \Storage::disk('public')->delete($donation->thumbnail);

        CategoriDonation::where('donation_id', $donation->id)->delete();

        $donation->forceDelete();
        if ($this->donationEdit != null) {
            $this->donationEdit = null;
            return redirect()->route("donation.index")->with("successDonation", "Berhasil menghapus permanen donation");
        }
        \session()->flash("successDonation", "Berhasil menghapus permanen donation");
    }

    public function cancelEdit()
    {
        return redirect()->route("donation.index");
    }
}
