<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view("pages.dashboard.profile.edit");
    }
}
