<div>
    <!-- File upload form -->
    <form wire:submit.prevent="store">
        <!-- File input -->
        <input type="file" wire:model="photos" multiple>

        <!-- Validation error display -->
        @error('photos.*') <span class="error">{{ $message }}</span> @enderror

        <!-- Progress bar -->
        <div wire:loading wire:target="photos" class="progress-bar">
            Uploading...
        </div>

        <!-- Submit button -->
        <button type="submit">Upload</button>
    </form>

    <!-- Flash message after upload -->
    @if (session()->has('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Show thumbnails of uploaded images -->
    @if ($uploadedFiles && $uploadedFiles->isNotEmpty())
        <div class="uploaded-images">
            @foreach ($uploadedFiles as $file)
                <div class="image-wrapper">
                    <img src="{{ asset('images/' . $file->photo) }}" alt="Uploaded Image" width="100">
                </div>
            @endforeach

        </div>
    @else
        <p>No images uploaded yet.</p>
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

        .uploaded-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-wrapper {
            border: 1px solid #ddd;
            padding: 5px;
            width: 100px;
            height: 100px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
    </style>
</div>
