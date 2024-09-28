<div>
   <form wire:submit="add">
        <input type="text" wire:model="todo">
        <button type="submit">Add</button>
   </form>

   <form wire:submit="addTask">
        <input type="text" wire:model="task" placeholder="Task">
        <button type="submit">Add</button>
    </form>

   <ul>
        @foreach ($todos as $todo)
            <li>{{ $todo }}</li>
        @endforeach
   </ul>

   <ul>
        @foreach ($tasks as $task)
            <li>{{ $task }}</li>
        @endforeach
   </ul>
</div>
