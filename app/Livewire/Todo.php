<?php

namespace App\Livewire;

use Livewire\Component;

class Todo extends Component
{
    public $todo = '';

    public $task = '';

    public $tasks = [];

    public $todos = ['code later'];

    public function add()
    {
        $this->todos[] =  $this->todo;

        $this->reset('todo');
    }

    public function addTask()
    {
        $this->tasks[] = $this->task;

        $this->reset('task');
    }

    public function updateTask($value)
    {
        $this->task = strtoupper($value);
    }

    // public function mount()
    // {
    //     $this->todos = [
    //         'code later'
    //     ];
    // }

    public function updatedTodo($value)
    {
        $this->todo = strtoupper($value);
    }

    public function render()
    {
        return view('livewire.todo');
    }
}
