<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TeacherObserver
{
    public function creating(Teacher $teacher): void
    {
        // Generate default password: lastname + birthdate (mdY)
        $birthdate = Carbon::parse($teacher->date_of_birth)->format('mdY');
        $password = Str::lower(Str::replace(' ', '', $teacher->last_name)) . $birthdate;

        // Create the user account
        $user = User::create([
            'name' => $teacher->first_name . ' ' . $teacher->last_name,
            'email' => $teacher->email,
            'password' => Hash::make($password),
            'role' => 'teacher',
        ]);

        // Link the user to the teacher
        $teacher->user_id = $user->id;
    }

    public function updating(Teacher $teacher): void
    {
        // Sync name/email changes to the user account
        if ($teacher->isDirty(['first_name', 'last_name', 'email'])) {
            $teacher->user?->update([
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
                'email' => $teacher->email,
            ]);
        }
    }

    public function deleting(Teacher $teacher): void
    {
        // Delete the linked user account as well
        $teacher->user?->delete();
    }
}