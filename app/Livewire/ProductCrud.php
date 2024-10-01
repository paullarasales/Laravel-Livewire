<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class ProductCrud extends Component
{
    use WithFileUploads;

    public $products, $product_name, $description, $product_id, $photo;
    public $isUpdate = false;

    protected $rules = [
        'product_name' => 'required|string',
        'description' => 'required|string',
        'photo' => 'nullable|image|max:1024' // 1MB Max size
    ];

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.product-crud');
    }

    public function resetForm()
    {
        $this->product_name = '';
        $this->description = '';
        $this->photo = null;
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->photo) {
            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('test', $imageName, 'public');
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

        $this->resetForm();
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

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);
        $imageName = $product->photo; 
    
        if ($this->photo) {
            if ($product->photo && File::exists(public_path('uploads/' . $product->photo))) {
                File::delete(public_path('uploads/' . $product->photo));
            }

            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('uploads', $imageName, 'public');
        }

        $product->update([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'photo' => $imageName
        ]);

        session()->flash('status', 'Product successfully updated!');
        $this->resetForm();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo && File::exists(public_path('uploads/' . $product->photo))) {
            File::delete(public_path('uploads/' . $product->photo));
        }

        $product->delete();
        $this->resetForm();
        session()->flash('status', 'Product successfully deleted!');
    }
}
