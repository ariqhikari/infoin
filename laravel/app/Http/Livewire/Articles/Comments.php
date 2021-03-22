<?php

namespace App\Http\Livewire\Articles;

use App\Article;
use Livewire\Component;
use Livewire\WithPagination;
use App\Comment;

class Comments extends Component
{
    use withPagination;
    public $search;
    public $idArticleEdit;
    public $statusDelete = false;
    public $paginate = 10;
    public $articleEdit;

    public function mount($articleEdit)
    {
        $this->articleEdit = $articleEdit;
    }

    public function render()
    {
        $title = Article::where('id', $this->articleEdit)->first()->title;

        if ($this->search == null) {
            $articleEdits = Comment::where('article_id', $this->articleEdit)->with(['article', 'user'])->orderBy("created_at", "DESC")->paginate($this->paginate);
        } else {
            $articleEdits = Comment::where('article_id', $this->articleEdit)->whereHas('user', function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%');
            })->latest()->paginate($this->paginate);
        }
        return view('livewire.articles.comments', compact("articleEdits", "title"));
    }

    public function delete($id)
    {
        $this->idArticleEdit = $id;
        $this->statusDelete = true;
    }

    public function cancel()
    {
        $this->statusDelete = false;
        \session()->flash("error", "Tidak Melanjutkan Penghapusan");
    }

    public function destroy()
    {
        $articleEdit = Comment::find($this->idArticleEdit);

        $articleEdit->delete();
        $this->statusDelete = false;
        \session()->flash("success", "Berhasil Melakukan Penghapusan");
    }
}
