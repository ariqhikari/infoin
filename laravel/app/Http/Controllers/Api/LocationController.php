<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        return Province::get();
    }

    public function regencies(Request $request, $province_id)
    {
        return Regency::where('province_id', $province_id)->get();
    }
}
