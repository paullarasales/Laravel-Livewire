<div>
    <style>
        img {
            height: 100px;
            width: 100px;
        }
    </style>
    <form wire:click="store" enctype="multipart/form-data">
        <div>
            <label>Product Image</label>
            <input type="file" wire:model="photo">
            @error('photo')
                <span>{{ $message }}</span>
            @enderror

            <!-- Show image preview -->
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" width="100" alt="Image Preview">
            @endif
        </div>

        <button type="submit">Save</button>
    </form>

    @foreach ($uploadedFiles as $upload)
        <img src="{{ asset('images/' . $upload->photo)}}" alt="">
    @endforeach
</div>