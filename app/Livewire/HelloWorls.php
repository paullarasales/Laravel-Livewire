<?php

namespace App\Livewire;

use Livewire\Component;

class HelloWorls extends Component
{
    public $name = "Paul"; // Property bound to the input field

    public function render()
    {
        return view('livewire.hello-worls');
    }
}
