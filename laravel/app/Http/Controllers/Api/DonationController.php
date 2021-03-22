<?php

namespace App\Http\Controllers\Api;

use App\Donation;
use App\DonationDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DateTime;

use Mail;
use App\Mail\MailNewDonation;
use App\Mail\MailFullDonation;
use App\User;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['donation_details', 'categories'])->where("status_id", 1)->paginate(6);

        if ($donations) {
            return response()->json(['status' => 'success', 'data' => $donations], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function danger()
    {
        $dayAfter = (new DateTime)->modify('+30 day')->format('Y-m-d');

        $dangerDonations = Donation::with(['donation_details', 'categories'])->where([
            ["status_id", "=", 1],
            ["donation_end", "<=", $dayAfter],
        ])->orderBy('donation_end', 'desc')->get();

        if (count($dangerDonations) >= 4) {
            $dangerDonations = $dangerDonations->take(4);
        }

        if ($dangerDonations) {
            return response()->json(['status' => 'success', 'data' => $dangerDonations], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function detail($slug)
    {
        $donation = Donation::with(['user.userBanks.bank', 'categories' =>  function ($query) {
            $query->limit(2);
        }, 'donation_details.user'])->where('slug', $slug)->first();

        if ($donation) {
            return response()->json(['status' => 'success', 'data' => $donation], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function donation(Request $request)
    {
        $request->validate([
            "donation_id" => "required",
            "user_id" => "required|exists:users,id",
            "donasi" => "required",
            "nama_rekening" => "required",
            "bukti_pembayaran" => "required",
        ]);

        if (!Str::contains($request->get('bukti_pembayaran'), 'image')) {
            return response([
                'success'   => false,
            ], 404);
        }

        $image = $request->get('bukti_pembayaran');
        $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

        \Image::make($request->get('bukti_pembayaran'))->save('storage/assets/donation/detail/' . $name);
        

        $donationDetail = DonationDetail::create([
            "donation_id" => $request->donation_id,
            "user_id" => $request->user_id,
            "donasi" => $request->donasi,
            "pesan" => $request->pesan,
            "nama_rekening" => $request->nama_rekening,
            "bukti_pembayaran" => 'assets/donation/detail/' . str_replace('"', '', $name)
        ]);

        $donation = Donation::findOrFail($request->donation_id);
        $user = User::findOrFail($donation->user_id);
        $donatur = User::findOrFail($request->user_id)->name;

        if ($donation->donation_details->sum('donasi') >= $donation->max_dana) {
            Mail::to($user)->send(new MailFullDonation($user, $donation));
        } else {
            Mail::to($user)->send(new MailNewDonation($user, $donatur, $donation));
        }

        if ($donationDetail) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
