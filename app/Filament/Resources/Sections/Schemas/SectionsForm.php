<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Models\Student;
use App\Models\Teacher;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SectionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Section Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('section_code')
                            ->label('Section Code')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('campus')
                            ->options(['Caloocan' => 'Caloocan', 'Malabon' => 'Malabon'])
                            ->required(),
                        Select::make('program')
                            ->options([
                                'BSIT' => 'BSIT',
                                'BSCS' => 'BSCS',
                                'BSIS' => 'BSIS',
                            ])
                            ->required(),
                        Select::make('year_level')
                            ->options([
                                '1st Year' => '1st Year',
                                '2nd Year' => '2nd Year',
                                '3rd Year' => '3rd Year',
                                '4th Year' => '4th Year',
                            ])
                            ->required(),
                        Select::make('term')
                            ->options([
                                '1st Semester' => '1st Semester',
                                '2nd Semester' => '2nd Semester',
                            ])
                            ->required(),
                        TextInput::make('school_year')
                            ->label('School Year')
                            ->placeholder('e.g. 2024-2025')
                            ->required(),
                    ]),

                Section::make('Assign Teachers')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('sectionTeachers')
                            ->label('Teachers & Subjects')
                            ->relationship()
                            ->schema([
                                Select::make('teacher_id')
                                    ->label('Teacher')
                                    ->options(
                                        Teacher::all()->mapWithKeys(
                                            fn ($t) => [$t->id => "{$t->first_name} {$t->last_name}"]
                                        )
                                    )
                                    ->required()
                                    ->searchable(),
                                TextInput::make('subject')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Teacher'),
                    ]),

                Section::make('Assign Students')
                    ->schema([
                        Select::make('students')
                            ->multiple()
                            ->relationship('students', 'last_name')
                            ->getOptionLabelFromRecordUsing(fn (Student $record) => "{$record->first_name} {$record->last_name} ({$record->student_id})")
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }
}