<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class StudentCrud extends Component
{
    use WithFileUploads;

    public $studentFile, $students, $name, $course, $student_id, $photo;
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
        $this->photo = null;
        $this->isUpdate = false;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->photo) {
            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs(
                'students', 
                $imageName,
                'public'
            );
        }

        $studentFile = Student::create([
            'name' => $this->name,
            'course' => $this->course,
            'photo' => $imageName
        ]);

        if ($studentFile) {
            session->flash('status', 'Student data uploaded successfully!');
        } else {
            session->flash('status', 'Student data failed to upload, Please try again!');
        }

        $this->resetForm();
    }

    public function edit($id) 
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->course = $student->course;
        $this->photo = $student->photo;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        $student = Student::findOrFail($this->student_id);
        $imageName = $student->photo;

        if ($this->photo) {
            if ($student->photo && File::exists(public_path('students/' . $student->photo))) {
                File::delete(public_path('students/' . $student->photo));
            }

            $imageName = time() . '.' . $this->photo->getClientOriginalExtension();

            $this->photo->storeAs('students', $imageName, 'public');
        }

        $student->update([
            'name' => $this->name,
            'course' => $this->course,
            'photo' => $imageName
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        $this->resetForm();
    }
}
