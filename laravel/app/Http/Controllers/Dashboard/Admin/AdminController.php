<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Eo_Verification;

class AdminController extends Controller
{
    public function adminList()
    {
        $role = 3;
        $blacklist = 0;
        return view("pages.dashboard.admin.users.index", compact("role", "blacklist"));
    }

    public function userList()
    {
        $role = 1;
        $blacklist = 0;
        return view("pages.dashboard.admin.users.index", compact("role", "blacklist"));
    }

    public function eoList()
    {
        $role = 2;
        $blacklist = 0;
        return view("pages.dashboard.admin.users.index", compact("role", "blacklist"));
    }

    public function blackList()
    {
        $role = null;
        $blacklist = 1;
        return view("pages.dashboard.admin.users.index", compact("role", "blacklist"));
    }
}
