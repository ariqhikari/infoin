<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Categori;

class Edit extends Component
{
    protected $listeners = [
        "edit"
    ];

    public $name;
    public $categoriId;

    public function render()
    {
        return view('livewire.admin.categories.edit');
    }

    public function edit($categori)
    {
        $this->name = $categori["name"];
        $this->categoriId = $categori["id"];
    }

    public function update()
    {
        $categori = Categori::find($this->categoriId);

        if ($categori) {
            $categori->update([
                "name" => $this->name,
                "slug" => \Str::slug($this->name)
            ]);

            $name = $this->name;
            $this->resetInput();
            $this->emit("storeUpdate", $name);
        } else {
            $this->resetInput();
            $this->emit("errorUpdate");
        }
    }

    public function resetInput()
    {
        $this->name = null;
        $this->categoriId = null;
    }
}
