<div>
    <style>
        img {
            height: 100px;
            width: 100px;
        }
    </style>
   <h1>Student Managements</h1>
    
   <form wire:submit.prevent="{{ $isUpdate ? 'update' : 'store'}}">
        <div>
            <label>Name:</label>
            <input type="text" wire:model="name">
            @error('name')
                <span>{{ $messge }}</span>
            @enderror
        </div>

        <div>
            <label>Course:</label>
            <input type="text" wire:model="course">
            @error('course')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Profile Pic</label>
            <input type="file" wire:model="photo">
            @error('photo')
                <span>{{ $message }}</span>
            @enderror

            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" width="100">
            @endif
        </div>

        <div>
            <button type="submit">{{ $isUpdate ? 'Update' : 'Save'}}</button>
            <button type="button" wire:click="resetForm">Clear</button>
        </div>
   </form>

   <h2>Student List</h2>
   
   @if($students->count())
        <table border="1">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <img src="{{ asset('students/' . $student->photo)}}" alt="No Profile">
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->course}}</td>
                        <td>
                            <button wire:click="edit({{ $student->id }})">Edit</button>
                            <button wire:click="delete({{ $student->id}})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students found.</p>
   @endif
</div>
