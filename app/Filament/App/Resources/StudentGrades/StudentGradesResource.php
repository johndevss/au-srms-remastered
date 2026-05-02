<?php

namespace App\Filament\App\Resources\StudentGrades;

use App\Filament\App\Resources\StudentGrades\Pages\ListStudentGrades;
use App\Models\Grade;
use App\Models\Student;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StudentGradesResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationLabel = 'My Grades';
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $slug = 'my-grades';

    public static function getEloquentQuery(): Builder
    {
        $student = auth()->user()?->student;

        if (! $student) {
            return parent::getEloquentQuery()->whereNull('id');
        }

        return parent::getEloquentQuery()
            ->where('student_id', $student->id)
            ->with(['section', 'teacher']);
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->role === 'student';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.section_code')
                    ->label('Section')
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.first_name')
                    ->label('Teacher')
                    ->formatStateUsing(fn ($state, Grade $record): string => $record->teacher?->first_name && $record->teacher?->last_name
                        ? trim("{$record->teacher->first_name} {$record->teacher->last_name}")
                        : 'N/A'),
                Tables\Columns\TextColumn::make('quarter_1')->label('Q1')->sortable(),
                Tables\Columns\TextColumn::make('quarter_2')->label('Q2')->sortable(),
                Tables\Columns\TextColumn::make('quarter_3')->label('Q3')->sortable(),
                Tables\Columns\TextColumn::make('quarter_4')->label('Q4')->sortable(),
                Tables\Columns\TextColumn::make('final_grade')->label('Final')->sortable(),
            ])
            ->defaultSort('section.section_code');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudentGrades::route('/'),
        ];
    }
}
