<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view("pages.dashboard.admin.bank.index");
    }

    public function user()
    {
        return view("pages.dashboard.admin.bank.user.index");
    }
}
