<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Eo_Verification;
use App\Jobs\EoVerificationJob;

use Mail;
use App\Mail\MailVerifyEoAccept;
use App\Mail\MailVerifyEoDecline;
use App\User;

class Eo_VerificationController extends Controller
{
    public function verification()
    {
        if (Auth::user()->phone == null) {
            return redirect()->back()->with("error", "Isi terlebih dahulu field nomor telepon kalian");
        }
        if (Auth::user()->verifications()) {
            if (Auth::user()->verifications()->status == 0 || Auth::user()->verifications()->status == 1) {
                return redirect()->back()->with("error", "Kamu sudah terdaftar");
            }
        }

        return view("pages.dashboard.user.verification-eo.verification");
    }

    public function store(Request $request)
    {
        $request->validate([
            "ktp" => "required|mimes:png,jpg,jpeg,svg,webp"
        ]);

        $recent = Eo_Verification::where("user_id", Auth::id())->where("status", 2)->get();
        $allFiles = \Storage::allFiles("public/assets/ktp");

        if (!empty($recent)) {
            foreach ($recent as $key => $value) {
                $recentKtp = \explode("/", $value->ktp);
                $recentKtp_name = $recentKtp[2];
                foreach ($allFiles as $key2 => $value2) {
                    $ktp_dir_explode = \explode("/", $value2);
                    if ($ktp_dir_explode[2] == $recentKtp_name) {
                        \Storage::disk("local")->delete($value2);
                    }
                }
                $value->delete();
            }
        }

        $ktp = $request->file('ktp')->store('assets/ktp', 'public');

        $verify = Eo_Verification::create([
            "user_id" => Auth::id(),
            "ktp" => $ktp,
        ]);

        EoVerificationJob::dispatch(Auth::user(), $verify)->delay(now()->addSeconds(5));

        return redirect()->route("profile.edit")->with("success", "Berhasil mengirimkan verifikasi ke admin, tunggu respon dari admin");
    }

    public function show($id)
    {
        $data = Eo_Verification::find($id);
        $data->update([
            "status_read" => 1
        ]);

        return view("pages.dashboard.admin.verifications.show", compact("data"));
    }

    public function index()
    {
        return view("pages.dashboard.admin.verifications.index");
    }

    public function readAll()
    {
        $data = Eo_Verification::where("status_read", 0)->get();
        foreach ($data as $key => $value) {
            $value->update([
                "status_read" => 1
            ]);
        }
        return redirect()->back()->with("success", "Notifikasi telah dibaca semua");
    }

    public function accept($id)
    {
        $data = Eo_Verification::find($id);
        $data->update([
            "status" => 1
        ]);
        $data->user->update([
            "role_id" => 2
        ]);

        Mail::to($data->user)->send(new MailVerifyEoAccept($data->user));

        return redirect()->back()->with("success", "Berhasil Menerima Permintaan Verifikasi");
    }

    public function decline($id)
    {
        $data = Eo_Verification::find($id);
        $data->update([
            "status" => 2
        ]);

        Mail::to($data->user)->send(new MailVerifyEoDecline($data->user));

        return redirect()->back()->with("success", "Berhasil Menolak Permintaan Verifikasi");
    }
}
