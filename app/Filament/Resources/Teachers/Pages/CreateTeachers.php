<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeachersResource;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateTeachers extends CreateRecord
{
    protected static string $resource = TeachersResource::class;

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
            'role' => 'teacher',
        ]);

        $data['user_id'] = $user->id;

        // Generate employee ID
        $data['employee_id'] = $this->generateEmployeeId($data['campus']);

        return static::getModel()::create($data);
    }

    protected function generateEmployeeId(string $campus): string
    {
        $campusCodes = [
            'Caloocan' => '01',
            'Malabon' => '02',
        ];

        $campusCode = $campusCodes[$campus] ?? '00';
        $year = now()->format('Y');

        $lastTeacher = Teacher::where('employee_id', 'like', "{$campusCode}-{$year}-%")
            ->orderBy('employee_id', 'desc')
            ->first();

        if ($lastTeacher) {
            $lastSequence = (int) Str::afterLast($lastTeacher->employee_id, '-');
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }

        return sprintf('%s-%s-%05d', $campusCode, $year, $newSequence);
    }
}