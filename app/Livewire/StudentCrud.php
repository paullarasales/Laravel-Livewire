<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentCrud extends Component
{
    public $students, $name, $course, $student_id;
    public $isUpdate = false;

    protected $rules = [
        'name' => 'required|string',
        'course' => 'required|string'
    ];

    public function render()
    {
        $this->students = Student::all();
        return view('livewire.student-crud');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->course = '';
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        Student::create([
            'name' => $this->name,
            'course' => $this->course
        ]);

        $this->resetForm();
    }

    public function edit($id) 
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->course = $student->course;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        $student = Student::findOrFail($this->student_id);
        $student->update([
            'name' => $this->name,
            'course' => $this->course,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        $this->resetForm();
    }
}
