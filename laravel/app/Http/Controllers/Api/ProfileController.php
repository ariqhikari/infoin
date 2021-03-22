<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Donation;
use App\Event;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use App\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug', $slug)->first();

        if ($user) {
            return response()->json(['status' => 'success', 'data' => $user], 200);
        } else {
            return response()->json(['status' => 'failed'], 404);
        }
    }

    public function article($slug)
    {
        $user = User::where('slug', $slug)->first();

        $articles = Article::with('categori')->where([
            ['user_id', $user->id],
            ['status_id', 1],
        ])->paginate(6);


        if ($user) {
            return response()->json(['status' => 'success', 'data' => $articles], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
    public function donation($slug)
    {
        $user = User::where('slug', $slug)->first();

        $donations = Donation::with(['donation_details', 'categories'])->where([
            ['user_id', $user->id],
            ['status_id', 1],
        ])->paginate(6);

        if ($donations) {
            return response()->json(['status' => 'success', 'data' => $donations], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function event($slug)
    {
        $user = User::where('slug', $slug)->first();

        $events = Event::where('user_id', $user->id)->paginate(6);

        foreach ($events as $event) {
            if ($event->date_start <= Carbon::now()->format('Y-m-d\TH:i') && $event->date_end >= Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Dimulai";
            } elseif ($event->date_start > Carbon::now()->format('Y-m-d\TH:i') && $event->date_end > Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Belum Dimulai";
            } elseif ($event->date_start < Carbon::now()->format('Y-m-d\TH:i') && $event->date_end < Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Selesai";
            }

            $province = Province::where('id', $event->province_id)->first();
            $regency = Regency::where('id', $event->regency_id)->first();

            $event->province = $province;
            $event->regency = $regency;
        }

        if ($events) {
            return response()->json(['status' => 'success', 'data' => $events], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
