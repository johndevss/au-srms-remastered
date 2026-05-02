<?php

namespace App\Filament\App\Widgets;

use App\Models\Grade;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentDashboardWidget extends BaseWidget
{
    protected ?string $heading = 'Student Dashboard';

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'student';
    }

    protected function getStats(): array
    {
        $student = Auth::user()?->student;

        if (! $student) {
            return [];
        }

        $sectionCount = DB::table('section_student')
            ->where('student_id', $student->id)
            ->count();

        $gradeCount = Grade::where('student_id', $student->id)
            ->whereNotNull('final_grade')
            ->count();

        $averageGrade = Grade::where('student_id', $student->id)
            ->whereNotNull('final_grade')
            ->avg('final_grade');

        $pendingCount = max(0, $sectionCount - $gradeCount);

        return [
            Stat::make('Enrolled Sections', $sectionCount)
                ->description('Sections you are currently enrolled in')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
            Stat::make('Grades Received', $gradeCount)
                ->description('Subjects with grades posted')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Pending Grades', $pendingCount)
                ->description('Subjects still waiting for grading')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Average Grade', $averageGrade ? number_format($averageGrade, 2) : 'N/A')
                ->description('Average of graded subjects')
                ->descriptionIcon('heroicon-m-star')
                ->color('info'),
        ];
    }
}
