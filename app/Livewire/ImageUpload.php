<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $photoFile, $photo;

    protected $rules = [
        'photo' => 'image|max:2048', 
    ];

    public function render()
    {
        $uploadedFiles = Image::all();
        return view('livewire.image-upload', ['uploadedFiles' => $uploadedFiles]);
    }

    public function resetForm()
    {
        $this->photo = null;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->photo) {
            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('images', $imageName, 'public');
        }

        $photoFile = Image::create([
            'photo' => $imageName
        ]);

        session()->flash('status', 'Image uploaded successfully!');

        $this->resetForm();
    }

}
