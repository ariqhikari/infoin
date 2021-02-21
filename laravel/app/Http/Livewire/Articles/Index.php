<?php

namespace App\Http\Livewire\Articles;

use Livewire\Component;
use App\Article;
use Livewire\WithPagination;
use App\Status;
use App\Categori;
use Auth;

class Index extends Component
{
    use WithPagination;
    public $active = null;
    public $search;
    public $articleEdit;

    public function mount($articleEdit)
    {
        $this->articleEdit = $articleEdit;
    }

    public function render()
    {
        if ($this->search != null) {
            if ($this->active == null) {
                if (Auth::user()->role_id != 3) {
                    $articles = Article::withTrashed()->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->latest()->paginate(10);
                } else {
                    $articles = Article::withTrashed()->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->latest()->paginate(10);
                }
            } else {
                if ($this->active == 1) {
                    $articles = $this->getSearch(1);
                } else if ($this->active == 2) {
                    $articles = $this->getSearch(2);
                } else if ($this->active == 3) {
                    $articles = $this->getSearchTrash();
                }
            }
        } else {
            if ($this->active == null) {
                if (Auth::user()->role_id != 3) {
                    $articles = Article::withTrashed()->where("user_id", Auth::id())->latest()->paginate(10);
                } else {
                    $articles = Article::withTrashed()->latest()->paginate(10);
                }
            } else {
                if ($this->active == 1) {
                    $articles = $this->getData(1);
                } else if ($this->active == 2) {
                    $articles = $this->getData(2);
                } else if ($this->active == 3) {
                    $articles = $this->getDataTrash();
                }
            }
        }

        if (Auth::user()->role_id != 3) {
            $all = Article::withTrashed()->where("user_id", Auth::id())->get();
            $trash = Article::onlyTrashed()->where("user_id", Auth::id())->count();
        } else {
            $all = Article::withTrashed()->get();
            $trash = Article::onlyTrashed()->count();
        }
        $status = Status::get();
        $categori = Categori::get();
        $draft = $this->getCount(2);
        $publish = $this->getCount(1);
        return view('livewire.articles.index', compact("articles", "status", "categori", "draft", "trash", "publish", "all"));
    }

    public function getData($active)
    {
        if (Auth::user()->role_id != 3) {
            $articles = Article::where("user_id", Auth::id())->where("status_id", $active)->latest()->paginate(10);
        } else {
            $articles = Article::where("status_id", $active)->latest()->paginate(10);
        }
        return $articles;
    }

    public function getSearch($active)
    {
        if (Auth::user()->role_id != 3) {
            $articles = Article::where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->where("status_id", $active)->latest()->paginate(10);
        } else {
            $articles = Article::where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("status_id", $active)->latest()->paginate(10);
        }
        return $articles;
    }

    public function getSearchTrash()
    {
        if (Auth::user()->role_id != 3) {
            $articles = Article::onlyTrashed()->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->where("user_id", Auth::id())->latest()->paginate(10);
        } else {
            $articles = Article::onlyTrashed()->where("title", $this->search)->orWhere("title", "like", "%" . $this->search . "%")->latest()->paginate(10);
        }
        return $articles;
    }

    public function getCount($status)
    {
        if (Auth::user()->role_id != 3) {
            return Article::where("user_id", Auth::id())->where("status_id", $status)->get()->count();
        } else {
            return Article::where("status_id", $status)->get()->count();
        }
    }

    public function active($number)
    {
        $this->active = $number;
    }

    public function nonActive()
    {
        $this->active = null;
    }

    public function toTrash($id)
    {
        $article = Article::find($id);
        $article->update([
            "status_id" => 3
        ]);
        $article->delete();
        \session()->flash("successArticle", "Berhasil memindahkan article ke tempat sampah");
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->find($id);
        $article->update([
            "status_id" => 2
        ]);
        $article->restore();
        \session()->flash("successArticle", "Berhasil memulihkan artikel");
    }

    public function getDataTrash()
    {
        if (Auth::user()->role_id != 3) {
            $article = Article::onlyTrashed()->where("user_id", Auth::id())->latest()->paginate(10);
        } else {
            $article = Article::onlyTrashed()->latest()->paginate(10);
        }
        return $article;
    }

    public function destroy($id)
    {
        $article = Article::onlyTrashed()->find($id);

        \Storage::disk('public')->delete($article->thumbnail);

        $article->forceDelete();
        if ($this->articleEdit != null) {
            $this->articleEdit = null;
            return redirect()->route("articles.index")->with("successArticle", "Berhasil menghapus permanen artikel");
        }
        \session()->flash("successArticle", "Berhasil menghapus permanen artikel");
    }

    public function cancelEdit()
    {
        return redirect()->route("articles.index");
    }
}
