<?php
namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    public function created(Student $student): void
    {
        if ($student->user) {
            $student->user->update(['role' => 'student']);
        }
    }
}