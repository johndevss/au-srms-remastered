<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Generate password: lowercase last_name + birthdate (MMDDYYYY)
        $birthdate = Carbon::parse($data['date_of_birth'])->format('mdY');
        $password = Str::lower(Str::replace(' ', '', $data['last_name'])) . $birthdate;

        // Create user account
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($password),
        ]);

        $data['user_id'] = $user->id;

        // Generate student ID: CC-YYYY-NNNNN
        $data['student_id'] = $this->generateStudentId($data['campus']);

        return static::getModel()::create($data);
    }

    protected function generateStudentId(string $campus): string
    {
        // Campus codes
        $campusCodes = [
            'Caloocan' => '01',
            'Malabon' => '02',
        ];

        $campusCode = $campusCodes[$campus] ?? '00';
        $year = now()->format('Y');

        // Get the last student ID for this campus and year
        $lastStudent = Student::where('student_id', 'like', "{$campusCode}-{$year}-%")
            ->orderBy('student_id', 'desc')
            ->first();

        if ($lastStudent) {
            // Extract the sequence number and increment
            $lastSequence = (int) Str::afterLast($lastStudent->student_id, '-');
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }

        // Format: CC-YYYY-NNNNN (5-digit sequence)
        return sprintf('%s-%s-%05d', $campusCode, $year, $newSequence);
    }
}
