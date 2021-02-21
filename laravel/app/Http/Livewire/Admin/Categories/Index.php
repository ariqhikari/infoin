<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Categori;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        "storeCategori",
        "storeUpdate",
        "errorUpdate"
    ];

    public $statusUpdate = false;

    public function render()
    {
        $categories = Categori::orderBy("name","ASC")->paginate(10);
        return view('livewire.admin.categories.index',compact("categories"));
    }

    public function storeCategori($name){
        \session()->flash("success","Berhasil Menambahkan " .$name. " kategori");
    }

    public function edit($id){
        $categori = Categori::find($id);
        $this->statusUpdate = true;
        $this->emit("edit",$categori);
    }

    public function delete($id){
        $categori = Categori::find($id);
        $name = $categori->name;
        $categori->delete();
        \session()->flash("success","Berhasil menghapus " .$name. " kategori");
    }

    public function storeUpdate($name){
        \session()->flash("success","Berhasil mengubah " .$name. " kategori");
        $this->statusUpdate = false;
    }

    public function errorUpdate(){
        \session()->flash("error","Gagal mengubah kategori");
        $this->statusUpdate = false;
    }
}
