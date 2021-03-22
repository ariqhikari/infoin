<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;

use App\Categori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view("pages.dashboard.admin.category.index");
    }
}
