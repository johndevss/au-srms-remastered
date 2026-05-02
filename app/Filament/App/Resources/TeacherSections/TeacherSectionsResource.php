<?php

namespace App\Filament\App\Resources\TeacherSections;

use App\Filament\App\Resources\TeacherSections\Pages\ListTeacherSections;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;

class TeacherSectionsResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationLabel = 'My Sections';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $slug = 'my-sections';

    // Only show sections belonging to the logged-in teacher
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        return parent::getEloquentQuery()
            ->whereHas('teachers', fn (Builder $q) => $q->where('teachers.id', $teacher?->id));
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_code')->label('Section'),
                Tables\Columns\TextColumn::make('campus'),
                Tables\Columns\TextColumn::make('program'),
                Tables\Columns\TextColumn::make('year_level')->label('Year Level'),
                Tables\Columns\TextColumn::make('term'),
                Tables\Columns\TextColumn::make('school_year')->label('School Year'),
                Tables\Columns\TextColumn::make('students_count')
                    ->label('Students')
                    ->counts('students'),
            ])
            ->recordAction(null)
            ->recordActions([
                Action::make('view_students')
                    ->label('View Students')
                    ->icon('heroicon-o-users')
                    ->modalHeading(fn (Section $record) => "Students in {$record->section_code}")
                    ->modalContent(fn (Section $record) => view(
                        'filament.app.modals.section-students',
                        ['section' => $record, 'teacher' => $teacher]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),

                Action::make('grade_students')
                    ->label('Grade')
                    ->icon('heroicon-o-pencil-square')
                    ->modalHeading(fn (Section $record) => "Grade Students - {$record->section_code}")
                    ->form(fn (Section $record) => [
                        \Filament\Forms\Components\Repeater::make('grades')
                            ->label('Student Grades')
                            ->schema([
                                Hidden::make('student_id'),
                                \Filament\Forms\Components\Select::make('student_id')
                                    ->label('Student')
                                    ->options(
                                        $record->students->mapWithKeys(
                                            fn ($s) => [$s->id => "{$s->first_name} {$s->last_name} ({$s->student_id})"]
                                        )
                                    )
                                    ->disabled()
                                    ->required(),
                                TextInput::make('quarter_1')->label('Q1')->numeric()->minValue(0)->maxValue(100),
                                TextInput::make('quarter_2')->label('Q2')->numeric()->minValue(0)->maxValue(100),
                                TextInput::make('quarter_3')->label('Q3')->numeric()->minValue(0)->maxValue(100),
                                TextInput::make('quarter_4')->label('Q4')->numeric()->minValue(0)->maxValue(100),
                            ])
                            ->columns(5)
                            ->addable(false)
                            ->deletable(false)
                            ->default(
                                $record->students->map(function ($student) use ($record, $teacher) {
                                    $grade = Grade::where([
                                        'student_id' => $student->id,
                                        'section_id' => $record->id,
                                        'teacher_id' => $teacher?->id,
                                    ])->first();

                                    return [
                                        'student_id' => $student->id,
                                        'quarter_1'  => $grade?->quarter_1,
                                        'quarter_2'  => $grade?->quarter_2,
                                        'quarter_3'  => $grade?->quarter_3,
                                        'quarter_4'  => $grade?->quarter_4,
                                    ];
                                })->toArray()
                            ),
                    ])
                    ->action(function (Section $record, array $data) use ($teacher) {
                        $subject = $record->teachers()
                            ->where('teachers.id', $teacher?->id)
                            ->first()?->pivot->subject;

                        foreach ($data['grades'] as $gradeData) {
                            Grade::updateOrCreate(
                                [
                                    'student_id' => $gradeData['student_id'],
                                    'section_id' => $record->id,
                                    'teacher_id' => $teacher?->id,
                                ],
                                [
                                    'subject'    => $subject,
                                    'quarter_1'  => $gradeData['quarter_1'] ?? null,
                                    'quarter_2'  => $gradeData['quarter_2'] ?? null,
                                    'quarter_3'  => $gradeData['quarter_3'] ?? null,
                                    'quarter_4'  => $gradeData['quarter_4'] ?? null,
                                ]
                            );
                        }

                        Notification::make()
                            ->title('Grades saved successfully')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeacherSections::route('/'),
        ];
    }
}