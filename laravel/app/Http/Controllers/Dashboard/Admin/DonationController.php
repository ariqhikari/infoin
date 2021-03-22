<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;

use App\Donation;
use App\Categori;
use App\CategoriDonation;
use App\DonationDetail;
use App\UserBank;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categori::get();
        if (Auth::user()->role_id != 3) {
            $userBanks = UserBank::where('user_id', Auth::user()->id)->get();
        } else {
            $userBanks = UserBank::get();
        }
        return view("pages.dashboard.admin.donation.index", compact("categories", "userBanks"));
    }

    public function pendonasi($donationDetail)
    {
        return view("pages.dashboard.admin.donation.detail", compact('donationDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:3|unique:events,title",
            "thumbnail" => "required|mimes:png,jpg,jpeg,svg,webp|max:2048",
            "categori_id" => "required",
            "content" => "required|min:5",
            "min_dana" => "required",
            "max_dana" => "required",
            "donation_end" => "required",
            "status_id" => "required"
        ]);

        $thumbnail = $request->file('thumbnail')->store('assets/donation', 'public');

        $donation = Donation::create([
            "user_id" => \Auth::user()->id,
            "title" => $request->title,
            "slug" => \Str::slug($request->title),
            "thumbnail" => $thumbnail,
            "min_dana" => $request->min_dana,
            "max_dana" => $request->max_dana,
            "content" => $request->content,
            "donation_end"
            => Carbon::parse($request->donation_end)->format('Y-m-d\TH:i'),
            "status_id" => $request->status_id,
        ]);

        foreach ($request->categori_id as $category) {
            $category = [
                'categori_id' => $category,
                'donation_id' => $donation->id
            ];

            CategoriDonation::create($category);
        }

        return redirect()->back()->with("successDonation", "Berhasil membuat donation baru");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit($donation)
    {
        $donationEdit = Donation::withTrashed()->where("id", $donation)->first();
        $categories = Categori::get();
        if ($donationEdit->user_id != Auth::id() && Auth::user()->role_id != 3) {
            return redirect()->back()->with("error", "Kamu tidak memiliki hak akses");
        }
        return view("pages.dashboard.admin.donation.index", compact("donationEdit", 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $donation)
    {
        $donationEdit = Donation::withTrashed()->where("id", $donation)->first();

        $request->validate([
            "title" => "required|min:3|unique:events,title," . $donationEdit->id,
            "thumbnail" => "mimes:png,jpg,jpeg,svg,webp|max:2048",
            "content" => "required|min:5",
            "min_dana" => "required",
            "max_dana" => "required",
            "donation_end" => "required",
            "status_id" => "required"
        ]);

        if ($request->thumbnail == null) {
            $donationEdit->update([
                "title" => $request->title,
                "slug" => \Str::slug($request->title),
                "min_dana" => $request->min_dana,
                "max_dana" => $request->max_dana,
                "content" => $request->content,
                "donation_end" =>
                Carbon::parse($request->donation_end)->format('Y-m-d\TH:i'),
                "status_id" => $request->status_id,
            ]);
        } else {
            \Storage::disk('public')->delete($donationEdit->thumbnail);
            $thumbnail = $request->thumbnail->storePublicly('assets/donation', 'public');

            $donationEdit->update([
                "thumbnail" => $thumbnail
            ]);
        }

        if ($request->categori_id) {
            CategoriDonation::where('donation_id', $donationEdit->id)->delete();

            foreach ($request->categori_id as $category) {
                $category = [
                    'categori_id' => $category,
                    'donation_id' => $donationEdit->id
                ];

                CategoriDonation::create($category);
            }
        }

        return redirect()->route("donation.index")->with("successDonation", "Berhasil merubah donation");
    }

    public function transaction()
    {
        return view("pages.dashboard.admin.donation.transaction.index");
    }
}
