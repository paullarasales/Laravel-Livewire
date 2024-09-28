<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anime;

class AnimeCrud extends Component
{
    public $anime, $code, $title, $genre, $anime_id;
    public $isUpdate = false;

    protected $rules = [
        'code' => 'required|string',
        'title' => 'required|string',
        'genre' => 'required|string'
    ]; 

    public function render()
    {
        $this->anime = Anime::all();
        return view('livewire.anime-crud');
    }

    public function resetForm()
    {
        $this->code = '';
        $this->title = '';
        $this->genre = '';
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        Anime::create([
            'code' => $this->code,
            'title' => $this->title,
            'genre' => $this->genre
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        $this->anime_id = $id;
        $this->code = $anime->code;
        $this->title = $anime->title;
        $this->genre = $anime->genre;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        $anime = Anime::findOrFail($this->anime_id);
        $anime->update([
            'code' => $this->code,
            'title' => $this->title,
            'genre' => $this->genre
        ]);
        
        $this->resetForm();
    }

    public function delete($id)
    {
        $anime = Anime::findOrFail($id)->delete();
        $this->resetForm();
    }
}
