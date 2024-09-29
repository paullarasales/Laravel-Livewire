<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $files = [];
    public $uploadedFiles = [];

    protected $rules = [
        'files.*' => 'image|max:2048', // Validate images only, max size 2MB
    ];

    public function updatedFiles()
    {
        $this->validate();
    }

    public function save()
    {
        foreach ($this->files as $file) {
            // Store files in the public/uploads directory
            $filename = $file->getClientOriginalName();  // Get original file name
            $file->storeAs('uploads', $filename, 'public_path'); // Store files in 'public/uploads'

            $this->uploadedFiles[] = 'uploads/' . $filename; // Save path to display images later
        }

        // Reset the file input after upload
        $this->reset('files');
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
