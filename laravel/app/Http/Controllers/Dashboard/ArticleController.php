<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Article;
use Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.dashboard.articles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:3|unique:articles,title",
            "thumbnail" => "required|mimes:png,jpg,jpeg,svg,webp",
            "content" => "required|min:10",
            "min_read" => "required",
            "categori_id" => "required",
            "status_id" => "required",
        ]);

        $thumbnail = $request->file('thumbnail')->store('assets/article', 'public');

        Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "min_read" => $request->min_read,
            "categori_id" => $request->categori_id,
            "status_id" => $request->status_id,
            "user_id" => Auth::id(),
            "slug" => \Str::slug($request->title),
            "thumbnail" => $thumbnail
        ]);

        return redirect()->back()->with("successArticle", "Berhasil membuat artikel baru");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function comment($articleEdit)
    {
        return view("pages.dashboard.articles.comment", compact('articleEdit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $articleEdit = Article::withTrashed()->where("slug", $article)->first();
        if ($articleEdit->user_id != Auth::id() && Auth::user()->role_id != 3) {
            return redirect()->back()->with("error", "Kamu tidak memiliki hak akses");
        }
        return view("pages.dashboard.articles.index", compact("articleEdit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $article)
    {
        $articleEdit = Article::withTrashed()->where("slug", $article);

        $request->validate([
            "title" => "required|min:3|unique:articles,title," . $articleEdit->id,
            "content" => "required|min:10",
            "min_read" => "required",
            "categori_id" => "required",
            "status_id" => "required",
        ]);

        if ($request->thumbnail == null) {
            $articleEdit->update([
                "title" => $request->title,
                "content" => $request->content,
                "min_read" => $request->min_read,
                "categori_id" => $request->categori_id,
                "status_id" => $request->status_id,
                "slug" => \Str::slug($request->title),
            ]);
        } else {
            // Menghapus thumbnail sebelumnya
            \Storage::disk('public')->delete($articleEdit->thumbnail);

            $thumbnail = $request->file('thumbnail')->store('assets/article', 'public');

            $articleEdit->update([
                "thumbnail" => $thumbnail
            ]);
        }

        return redirect()->route("articles.index")->with("successArticle", "Berhasil merubah artikel");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function image(Request $request)
    {
        $request->validate([
            "file" => "required|mimes:jpg,jpeg,svg,webp",
        ]);

        $image = $request->file('file')->store('assets/article/detail', 'public');

        return url('/storage/' . $image);
    }

    public function deleteImage(Request $request)
    {
        $src = $request->src;
        $src = \Str::after($src, asset('storage/'));
        \Storage::disk('public')->delete($src);

        return 'Delete file successfull!';
    }
}
