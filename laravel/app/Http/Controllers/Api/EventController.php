<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['user'])->orderBy('updated_at', 'DESC')->paginate(6);

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

    public function search(Request $request)
    {
        $events = Event::where([
            ["regency_id", '=', $request->get('q')],
        ])->get();

        foreach ($events as $event) {
            if ($event->date_start <= Carbon::now()->format('Y-m-d\TH:i') && $event->date_end >= Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Dimulai";
            } elseif ($event->date_start > Carbon::now()->format('Y-m-d\TH:i') && $event->date_end > Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Belum Dimulai";
            } elseif ($event->date_start < Carbon::now()->format('Y-m-d\TH:i') && $event->date_end < Carbon::now()->format('Y-m-d\TH:i')) {
                $event->status = "Selesai";
            }
        }

        if ($events) {
            return response()->json(['status' => 'success', 'data' => $events], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function detail($slug)
    {
        $event = Event::with(['user'])->where('slug', $slug)->first();

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

        if ($event) {
            return response()->json(['status' => 'success', 'data' => $event], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
