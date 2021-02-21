<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Categori;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.admin.categories.create');
    }

    public function store()
    {
        $this->validate([
            "name" => "required|min:3"
        ]);

        $categori = Categori::create([
            "name" => $this->name,
            "slug" => \Str::slug($this->name)
        ]);

        $name = $categori->name;
        $this->resetInput();
        $this->emit("storeCategori", $name);
    }

    public function resetInput()
    {
        $this->name = null;
    }
}
