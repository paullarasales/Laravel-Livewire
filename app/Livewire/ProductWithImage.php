<?php

namespace App\Livewire;

use Livewire\Component;

class ProductWithImage extends Component
{
    public $products, $product_name, $description, $photo, $product_id;
    public $isUpdate;
    
    protected $rules = [
        'product_name' => 'required|string',
        'description' => 'required|string',
        'photo' => 'image|max:2048',
    ];

    public function render()
    {
        return view('livewire.product-with-image');
    }

    public function resetForn()
    {
        $this->product_name = '';
        $this->description = '';
        $this->photo = '';
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->photo) {
            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('uploads', $imageName, 'public');
        }

        $product = Product::create([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'photo' => $imageName
        ]);

        if ($product) {
            session()->flash('status', 'Product successfully added!');
        } else {
            session()->flash('status', 'Error adding product. Please try again.');
        }

        $this->reset();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->product_name = $product->product_name;
        $this->description = $product->description;
        $this->photo = $product->photo;
        $this->isUpdate = true;
    }
}
