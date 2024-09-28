<div>
    <h1>Product Managements</h1>

    <form wire:submit.prevent="{{ $isUpdate ? 'update' : 'store'}}">
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
            <button type="submit">{{ $isUpdate ? 'Update' : 'Save'}}</button>
            <button type="button" wire:click="resetForm">Clear</button>
        </div>
    </form>

    <h1>Product List</h1>

    @if($products->count())
        <table border="1">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_name}}</td>
                        <td>{{ $product->description}}</td>
                        <td>
                            <button wire:click="edit({{ $product->id}})">Edit</button>
                            <button wire:click="delete({{ $product->id}})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products found</p>
    @endif
</div>
