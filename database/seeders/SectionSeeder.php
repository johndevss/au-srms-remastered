<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $campuses = ['Caloocan', 'Malabon'];
        $programs = ['BSIT', 'BSCS', 'BSIS'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $terms = ['1st Semester', '2nd Semester'];
        $schoolYear = '2025-2026';

        $subjects = [
            'Programming Fundamentals',
            'Database Systems',
            'Web Development',
            'Algorithms',
            'Computer Architecture',
            'Software Engineering',
            'Information Systems',
            'Business Analysis',
            'Systems Integration',
        ];

        $sectionCounts = [
            'Caloocan' => 0,
            'Malabon' => 0,
        ];

        for ($i = 0; $i < 8; $i++) {
            $campus = fake()->randomElement($campuses);
            $program = fake()->randomElement($programs);
            $yearLevel = fake()->randomElement($yearLevels);
            $term = fake()->randomElement($terms);

            $sectionCounts[$campus]++;
            $sectionCode = sprintf('%s-%s-%02d', strtoupper(substr($campus, 0, 3)), substr($schoolYear, 0, 4), $sectionCounts[$campus]);

            $section = Section::create([
                'section_code' => $sectionCode,
                'campus' => $campus,
                'program' => $program,
                'year_level' => $yearLevel,
                'school_year' => $schoolYear,
                'term' => $term,
            ]);

            $students = Student::where('campus', $campus)
                ->where('program', $program)
                ->where('year_level', $yearLevel)
                ->inRandomOrder()
                ->limit(10)
                ->pluck('id');

            if ($students->isNotEmpty()) {
                $section->students()->attach($students->toArray());
            }

            $teachers = Teacher::where('campus', $campus)
                ->inRandomOrder()
                ->limit(2)
                ->get();

            foreach ($teachers as $teacher) {
                $section->teachers()->attach($teacher->id, [
                    'subject' => fake()->randomElement($subjects),
                ]);
            }
        }

        $this->command->info('Created 8 sections with assigned students and teachers.');
    }
}
