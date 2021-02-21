<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Article;

class ListArticles extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where("status_id",1)->latest()->paginate(5);
        return view('livewire.admin.list-articles',compact("articles"));
    }

    public function unpublish($id){
        $article = Article::find($id);
        $article->update([
            "status_id" => 2
        ]);
        \session()->flash("success","Berhasil unpublish artikel $article->title");
    }
}
