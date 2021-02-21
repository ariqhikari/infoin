<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->name == 'admin') {
            $user = User::where("role_id", 1)->get();
            $admin = User::where("role_id", 3)->get();
            $eo = User::where("role_id", 2)->get();
            return view("pages.dashboard.home", compact("user", "admin", "eo"));
        } else {
            return view("pages.dashboard.home");
        }
    }
}
