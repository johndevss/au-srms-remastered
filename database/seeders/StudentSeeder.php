<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campuses = ['Caloocan', 'Malabon'];
        $programs = ['BSIT', 'BSCS', 'BSIS'];
        $admitTypes = ['Freshman', 'Transferee'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $terms = ['1st Semester', '2nd Semester'];
        $genders = ['Male', 'Female'];
        $civilStatuses = ['Single', 'Married'];
        $religions = ['Roman Catholic', 'Christian', 'Islam', 'Iglesia ni Cristo', 'Baptist'];
        $schoolTypes = ['Public', 'Private'];

        $firstNames = [
            'Male' => ['Juan', 'Jose', 'Pedro', 'Miguel', 'Antonio', 'Carlos', 'Manuel', 'Rafael', 'Gabriel', 'Daniel', 'Mark', 'John', 'James', 'Francis', 'Rico'],
            'Female' => ['Maria', 'Ana', 'Rosa', 'Carmen', 'Elena', 'Isabella', 'Sofia', 'Gabriela', 'Andrea', 'Patricia', 'Jessica', 'Angela', 'Christine', 'Michelle', 'Nicole'],
        ];

        $lastNames = ['Santos', 'Reyes', 'Cruz', 'Bautista', 'Garcia', 'Mendoza', 'Torres', 'Gonzales', 'Ramos', 'Fernandez', 'Flores', 'Lopez', 'Martinez', 'Rodriguez', 'Dela Cruz', 'De Guzman', 'Villanueva', 'Castro', 'Rivera', 'Aquino'];

        $middleNames = ['Aquino', 'Bautista', 'Cruz', 'Domingo', 'Espino', 'Flores', 'Garcia', 'Hernandez', 'Ignacio', 'Jimenez'];

        $barangays = ['Bagumbong', 'Bagong Silang', 'Camarin', 'Caloocan', 'Tala', 'Llano', 'Potrero', 'Tinajeros', 'Longos', 'Hulong Duhat'];
        $cities = ['Caloocan City', 'Malabon City', 'Quezon City', 'Manila', 'Valenzuela City', 'Navotas City'];
        $provinces = ['Metro Manila', 'Bulacan', 'Rizal', 'Cavite', 'Laguna'];

        $highSchools = [
            'Caloocan National Science and Technology High School',
            'Caloocan High School',
            'Malabon National High School',
            'Grace Park High School',
            'Maypajo High School',
            'St. James Academy',
            'Holy Cross High School',
            'San Bartolome High School',
        ];

        $occupations = ['Teacher', 'Engineer', 'Nurse', 'Driver', 'Business Owner', 'OFW', 'Government Employee', 'Private Employee', 'Self-employed', 'Housewife'];

        // Track student counts per campus for ID generation
        $studentCounts = [
            'Caloocan' => 0,
            'Malabon' => 0,
        ];

        $campusCodes = [
            'Caloocan' => '01',
            'Malabon' => '02',
        ];

        // Create 50 students
        for ($i = 0; $i < 50; $i++) {
            $gender = fake()->randomElement($genders);
            $firstName = fake()->randomElement($firstNames[$gender]);
            $lastName = fake()->randomElement($lastNames);
            $middleName = fake()->randomElement($middleNames);
            $campus = fake()->randomElement($campuses);
            $dateOfBirth = fake()->dateTimeBetween('-25 years', '-17 years');
            $birthdate = Carbon::parse($dateOfBirth)->format('mdY');

            // Generate password
            $password = Str::lower(Str::replace(' ', '', $lastName)) . $birthdate;

            // Generate student ID
            $studentCounts[$campus]++;
            $year = now()->format('Y');
            $studentId = sprintf('%s-%s-%05d', $campusCodes[$campus], $year, $studentCounts[$campus]);

            // Create user
            $email = Str::lower($firstName . '.' . Str::replace(' ', '', $lastName) . $i . '@student.au.edu.ph');
            $user = User::create([
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            // Create student
            Student::create([
                'student_id' => $studentId,
                'user_id' => $user->id,
                'campus' => $campus,
                'program' => fake()->randomElement($programs),
                'admit_type' => fake()->randomElement($admitTypes),
                'year_level' => fake()->randomElement($yearLevels),
                'school_year' => '2025-2026',
                'term' => fake()->randomElement($terms),
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'suffix' => fake()->optional(0.1)->randomElement(['Jr.', 'Sr.', 'III', 'IV']),
                'gender' => $gender,
                'civil_status' => fake()->randomElement($civilStatuses),
                'citizenship' => 'Filipino',
                'date_of_birth' => $dateOfBirth,
                'birthplace' => fake()->randomElement($cities),
                'religion' => fake()->randomElement($religions),
                'current_street_no' => fake()->buildingNumber(),
                'current_street' => fake()->streetName(),
                'current_subdivision' => fake()->optional(0.5)->word() . ' Village',
                'current_barangay' => fake()->randomElement($barangays),
                'current_city' => fake()->randomElement($cities),
                'current_province' => fake()->randomElement($provinces),
                'current_zip_code' => fake()->numberBetween(1400, 1500),
                'permanent_street_no' => fake()->buildingNumber(),
                'permanent_street' => fake()->streetName(),
                'permanent_subdivision' => fake()->optional(0.5)->word() . ' Subdivision',
                'permanent_barangay' => fake()->randomElement($barangays),
                'permanent_city' => fake()->randomElement($cities),
                'permanent_province' => fake()->randomElement($provinces),
                'permanent_zip_code' => fake()->numberBetween(1400, 1500),
                'telephone_no' => fake()->optional(0.3)->numerify('8###-####'),
                'mobile_no' => fake()->numerify('09#########'),
                'email' => $email,
                'last_school_type' => fake()->randomElement($schoolTypes),
                'last_school_name' => fake()->randomElement($highSchools),
                'last_school_program' => 'STEM',
                'last_school_date_of_graduation' => fake()->optional(0.7)->dateTimeBetween('-2 years', 'now'),
                'last_school_year' => '2024-2025',
                'last_school_year_level' => 'Grade 12',
                'last_school_term' => '2nd Semester',
                'father_first_name' => fake()->randomElement($firstNames['Male']),
                'father_last_name' => $lastName,
                'father_middle_initial' => strtoupper(fake()->randomLetter()),
                'father_suffix' => fake()->optional(0.1)->randomElement(['Jr.', 'Sr.']),
                'father_mobile_no' => fake()->numerify('09#########'),
                'father_email' => fake()->optional(0.5)->safeEmail(),
                'father_occupation' => fake()->randomElement($occupations),
                'mother_first_name' => fake()->randomElement($firstNames['Female']),
                'mother_last_name' => fake()->randomElement($lastNames),
                'mother_middle_initial' => strtoupper(fake()->randomLetter()),
                'mother_suffix' => null,
                'mother_mobile_no' => fake()->numerify('09#########'),
                'mother_email' => fake()->optional(0.5)->safeEmail(),
                'mother_occupation' => fake()->randomElement($occupations),
                'guardian_first_name' => fake()->optional(0.3)->randomElement(array_merge($firstNames['Male'], $firstNames['Female'])),
                'guardian_last_name' => fake()->optional(0.3)->randomElement($lastNames),
                'guardian_middle_initial' => fake()->optional(0.3)->randomLetter(),
                'guardian_suffix' => null,
                'guardian_mobile_no' => fake()->optional(0.3)->numerify('09#########'),
                'guardian_email' => fake()->optional(0.2)->safeEmail(),
                'guardian_occupation' => fake()->optional(0.3)->randomElement($occupations),
                'guardian_relationship' => fake()->optional(0.3)->randomElement(['Uncle', 'Aunt', 'Grandmother', 'Grandfather', 'Sibling']),
            ]);
        }

        $this->command->info('Created 50 students with user accounts.');
    }
}
