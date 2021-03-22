<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Categori;
use App\Donation;

class CategoryController extends Controller
{
    public function article($slug)
    {
        $category = Categori::where('slug', $slug)->first();

        $articles = Article::with(['user', 'categori', 'status'])->where([
            ["status_id", 1],
            ["categori_id", $category->id]
        ])->paginate(6);

        if ($articles) {
            return response()->json(['status' => 'success', 'data' => $articles], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function donation($slug)
    {
        $category = Categori::where('slug', $slug)->first();

        $donations = Donation::with(['user', 'donation_details', 'categories'])->where([
            ["status_id", 1],
        ])->whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->paginate(6);

        if ($donations) {
            return response()->json(['status' => 'success', 'data' => $donations], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
