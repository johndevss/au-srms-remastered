<?php

namespace App\Filament\App\Resources\StudentGrades\Pages;

use App\Filament\App\Resources\StudentGrades\StudentGradesResource;
use Filament\Resources\Pages\ListRecords;

class ListStudentGrades extends ListRecords
{
    protected static string $resource = StudentGradesResource::class;
}
