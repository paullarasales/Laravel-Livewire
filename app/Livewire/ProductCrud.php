<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCrud extends Component
{
    public $products, $product_name, $description, $product_id;
    public $isUpdate = false;

    protected $rules = [
        'product_name' => 'required|string',
        'description' => 'required|string'
    ];

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.product-crud');
    }

    public function resetForm()
    {
        $this->product_name = '';
        $this->details = '';
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        Product::create([
            'product_name' => $this->product_name,
            'description' => $this->description
        ]);
        
        $this->resetForm();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->product_name = $product->product_name;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);
        $product->update([
            'product_name' => $this->product_name,
            'description' => $this->description
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        $this->resetForm();
    }
}
