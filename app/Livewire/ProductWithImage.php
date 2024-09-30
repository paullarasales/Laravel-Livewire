<?php

namespace App\Livewire;

use Livewire\Component;

class ProductWithImage extends Component
{
    public $image;
    
    protected $rules = [
        'photo' => 'image|max:2048',
    ];

    public function render()
    {
        return view('livewire.product-with-image');
    }

    

    
}
