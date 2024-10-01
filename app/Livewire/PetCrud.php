<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pet;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class PetCrud extends Component
{
    use WithFileUploads;
    
    public $petData, $pets, $name, $breed, $photo, $pet_id;
    public $isUpdate = false;

    protected $rules = [
        'name'=> 'required|string',
        'breed' => 'required|string',
        'photo' => 'nullable|image|max:2048'
    ];

    public function render()
    {
        $this->pets = Pet::all();
        return view('livewire.pet-crud');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->breed = '';
        $this->photo = null;
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->photo) {
            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('pets', $imageName, 'public');
        }

        $petData = Pet::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'photo' => $imageName
        ]);

        if ($petData) {
            session()->flash('success', 'Pet data uploaded successfully!');
        } else {
            session()->flash('status', 'Pet data not uploaded, Please try again later!');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $this->pet_id = $id;
        $this->name = $pet->name;
        $this->breed = $pet->breed;
        $this->photo = $pet->photo;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        $pet = Pet::findOrFail($this->pet_id);
        $imageName =  $pet->photo;

        if ($this->photo) {
            if ($pet->photo && File::exist(public_path('pets/' . $pet->photo))) {
                File::delete(public_path('pets/' . $pet->photo));
            }

            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('pets', $imageName, 'public');
        }

        $pet->update([
            'name' => $this->name,
            'breed' => $his->breed,
            'photo' => $imageName,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Pet::findOrFail($id)->delete();
        $this->resetForm();
    }
}
