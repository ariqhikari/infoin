<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Visitor;

class VisitorController extends Controller
{
    public function index()
    {
        return view("pages.dashboard.admin.visitors.index");
    }
}
