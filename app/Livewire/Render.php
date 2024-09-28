<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Render extends Component
{
    public $users = [];

    public function handleClick()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.render');
    }
}
