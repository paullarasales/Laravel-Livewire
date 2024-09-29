<div>
    <form wire:submit.prevent="save">
        <!-- File input -->
        <input type="file" wire:model="files" multiple>

        @error('files.*') <span class="error">{{ $message }}</span> @enderror

        <!-- Progress bar -->
        <div wire:loading wire:target="files" class="progress-bar">
            Uploading...
        </div>

        <!-- Submit button -->
        <button type="submit">Upload</button>
    </form>

    <!-- Show thumbnails of uploaded images -->
    @if ($uploadedFiles)
        <div class="uploaded-images">
            @foreach ($uploadedFiles as $file)
                <img src="{{ asset($file) }}" alt="Uploaded Image" width="100">
            @endforeach
        </div>
    @endif

    <style>
        .progress-bar {
            background-color: #4caf50;
            height: 10px;
            width: 0;
            animation: loading 2s linear infinite;
        }
    
        @keyframes loading {
            0% {
                width: 0;
            }
            100% {
                width: 100%;
            }
        }
    </style>
</div>


