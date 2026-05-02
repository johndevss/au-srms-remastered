<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $campuses = ['Caloocan', 'Malabon'];
        $departments = ['Computer Studies', 'Engineering', 'Education', 'Business Administration', 'Arts and Sciences'];
        $positions = ['Instructor', 'Assistant Professor', 'Associate Professor', 'Professor'];
        $employmentTypes = ['Full-time', 'Part-time'];
        $employmentStatuses = ['Active'];
        $genders = ['Male', 'Female'];
        $civilStatuses = ['Single', 'Married'];
        $religions = ['Roman Catholic', 'Christian', 'Islam', 'Iglesia ni Cristo', 'Baptist'];
        $citizenships = ['Filipino'];
        $attainments = ['Bachelor', 'Master', 'Doctorate'];
        $degrees = ['BSIT', 'BSCS', 'BSED', 'BSBA', 'MAEd', 'MIT', 'PhD in Computer Science'];

        $firstNames = [
            'Male' => ['Juan', 'Jose', 'Pedro', 'Miguel', 'Antonio', 'Carlos', 'Manuel', 'Rafael', 'Gabriel', 'Daniel'],
            'Female' => ['Maria', 'Ana', 'Rosa', 'Carmen', 'Elena', 'Isabella', 'Sofia', 'Gabriela', 'Andrea', 'Patricia'],
        ];

        $lastNames = ['Santos', 'Reyes', 'Cruz', 'Bautista', 'Garcia', 'Mendoza', 'Torres', 'Gonzales', 'Ramos', 'Fernandez'];
        $middleNames = ['Aquino', 'Bautista', 'Cruz', 'Domingo', 'Espino', 'Flores', 'Garcia', 'Hernandez', 'Ignacio', 'Jimenez'];

        $barangays = ['Bagumbong', 'Bagong Silang', 'Camarin', 'Caloocan', 'Tala', 'Llano', 'Potrero', 'Tinajeros', 'Longos', 'Hulong Duhat'];
        $cities = ['Caloocan City', 'Malabon City', 'Quezon City', 'Manila', 'Valenzuela City'];
        $provinces = ['Metro Manila', 'Bulacan', 'Rizal'];

        $schools = [
            'University of Santo Tomas',
            'De La Salle University',
            'Ateneo de Manila University',
            'University of the Philippines',
            'Polytechnic University of the Philippines',
            'Mapua University',
            'Far Eastern University',
            'National University',
        ];

        $campusCodes = [
            'Caloocan' => '01',
            'Malabon' => '02',
        ];

        $employeeCounts = [
            'Caloocan' => 0,
            'Malabon' => 0,
        ];

        for ($i = 0; $i < 20; $i++) {
            $gender = fake()->randomElement($genders);
            $firstName = fake()->randomElement($firstNames[$gender]);
            $lastName = fake()->randomElement($lastNames);
            $middleName = fake()->randomElement($middleNames);
            $campus = fake()->randomElement($campuses);
            $dateOfBirth = fake()->dateTimeBetween('-55 years', '-25 years');
            $dateOfBirthCarbon = Carbon::parse($dateOfBirth);

            // Generate employee ID (e.g. 01-2024-00001)
            $employeeCounts[$campus]++;
            $year = now()->format('Y');
            $employeeId = sprintf('%s-%s-%05d', $campusCodes[$campus], $year, $employeeCounts[$campus]);

            // Generate email
            $email = Str::lower($firstName . '.' . Str::replace(' ', '', $lastName) . $i . '@au.edu.ph');

            Teacher::create([
                'employee_id'                   => $employeeId,
                'campus'                        => $campus,
                'department'                    => fake()->randomElement($departments),
                'position'                      => fake()->randomElement($positions),
                'employment_type'               => fake()->randomElement($employmentTypes),
                'employment_status'             => 'Active',
                'date_hired'                    => fake()->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                'first_name'                    => $firstName,
                'middle_name'                   => $middleName,
                'last_name'                     => $lastName,
                'suffix'                        => null,
                'gender'                        => $gender,
                'civil_status'                  => fake()->randomElement($civilStatuses),
                'citizenship'                   => 'Filipino',
                'date_of_birth'                 => $dateOfBirthCarbon->format('Y-m-d'),
                'birthplace'                    => fake()->randomElement($cities),
                'religion'                      => fake()->randomElement($religions),
                'street_no'                     => fake()->buildingNumber(),
                'street'                        => fake()->streetName(),
                'subdivision'                   => null,
                'barangay'                      => fake()->randomElement($barangays),
                'city'                          => fake()->randomElement($cities),
                'province'                      => fake()->randomElement($provinces),
                'zip_code'                      => fake()->numerify('####'),
                'telephone_no'                  => null,
                'mobile_no'                     => '09' . fake()->numerify('#########'),
                'email'                         => $email,
                'highest_educational_attainment'=> fake()->randomElement($attainments),
                'degree'                        => fake()->randomElement($degrees),
                'school'                        => fake()->randomElement($schools),
                'year_graduated'                => fake()->numberBetween(1990, 2020),
            ]);
        }
    }
}