<div>
    <h1>Product Management</h1>

    <form wire:submit.prevent="{{ $isUpdate ? 'update' : 'store'}}" enctype="multipart/form-data">
        <div>
            <label>Product Name</label>
            <input type="text" wire:model="product_name">
            @error('product_name')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Description</label>
            <input type="text" wire:model="description">
            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>

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

        <div>
            <button type="submit">{{ $isUpdate ? 'Update' : 'Save'}}</button>
            <button type="button" wire:click="resetForm">Clear</button>
        </div>
    </form>

        <h2>Product List</h2>
    
        @if($products->isEmpty())
            <p>No products available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                @if($product->photo)
                                    <img src="{{ asset('uploads/' . $product->photo) }}" alt="{{ $product->product_name }}" width="100">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                <!-- Add actions like Edit and Delete -->
                                <button wire:click="edit({{ $product->id }})">Edit</button>
                                <button wire:click="delete({{ $product->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    
</div>
