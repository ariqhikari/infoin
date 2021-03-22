<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use DateTime;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user', 'categori'])->where("status_id", 1)->paginate(6);

        if ($articles) {
            return response()->json(['status' => 'success', 'data' => $articles], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function search(Request $request)
    {
        $articles = Article::where([
            ["status_id", '=', 1],
            ["title", 'LIKE', '%' . $request->get('q') . '%'],
        ])->get();

        if ($articles) {
            return response()->json(['status' => 'success', 'data' => $articles], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function latest()
    {
        $articles = Article::with(['user', 'categori'])->where([
            ["status_id", '=', 1],
        ])->orderBy('updated_at', 'DESC')->take(4)->get();

        if ($articles) {
            return response()->json(['status' => 'success', 'data' => $articles], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function detail($slug)
    {
        $article = Article::with(['user', 'categori'])->where('slug', $slug)->first();
        $latestArticles = Article::with(['user', 'categori'])->where([
            ["status_id", '=', 1],
            ["id", '!=', $article->id],
            ["categori_id", '=', $article->categori_id],
        ])->orderBy('updated_at', 'DESC')->take(3)->get();
        $comments = Comment::with(['user.role', 'childs.user.role'])->where("article_id", $article->id)->where("parent", 0)->get();

        if ($article) {
            return response()->json(['status' => 'success', 'data' =>
            [
                'article' => $article,
                'latestArticles' => $latestArticles,
                'comments' => $comments,
            ]], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function comment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'article_id' => 'required',
            'comment' => 'required',
            'parent' => 'required',
        ]);

        $comment = Comment::create([
            "user_id" => $request->user_id,
            "article_id" => $request->article_id,
            "comment" => $request->comment,
            "parent" => $request->parent
        ]);


        if ($comment) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
