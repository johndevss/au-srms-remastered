<?php

namespace App\Filament\App\Widgets;

use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherDashboardWidget extends BaseWidget
{
    protected ?string $heading = 'Teacher Dashboard';

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'teacher';
    }

    protected function getStats(): array
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (! $teacher) {
            return [];
        }

        $sectionIds = DB::table('section_teacher')
            ->where('teacher_id', $teacher->id)
            ->pluck('section_id')
            ->toArray();

        $studentsCount = DB::table('section_student')
            ->whereIn('section_id', $sectionIds)
            ->distinct()
            ->count('student_id');

        $studentsToGrade = DB::table('section_student')
            ->whereIn('section_student.section_id', $sectionIds)
            ->leftJoin('grades', function ($join) use ($teacher) {
                $join->on('grades.student_id', '=', 'section_student.student_id')
                    ->on('grades.section_id', '=', 'section_student.section_id')
                    ->where('grades.teacher_id', '=', $teacher->id);
            })
            ->whereNull('grades.id')
            ->distinct()
            ->count('section_student.student_id');

        return [
            Stat::make('Students Currently Teaching', $studentsCount)
                ->description('Unique students in your assigned sections')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Students To Grade', $studentsToGrade)
                ->description('Students without a recorded grade yet')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning'),
        ];
    }
}
