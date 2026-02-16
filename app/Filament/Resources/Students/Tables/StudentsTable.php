<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student ID')
                    ->sortable()
                    ->searchable()
                    ->copyable(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->state(fn ($record) => $record->first_name . ' ' . ($record->middle_name ? $record->middle_name[0] . '. ' : '') . $record->last_name . ($record->suffix ? ' ' . $record->suffix : ''))
                    ->searchable(['first_name', 'last_name', 'middle_name']),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('mobile_no')
                    ->label('Mobile')
                    ->searchable(),
                TextColumn::make('campus')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Caloocan' => 'success',
                        'Malabon' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('program')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('year_level')
                    ->label('Year'),
                TextColumn::make('created_at')
                    ->label('Enrolled')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('campus')
                    ->options([
                        'Caloocan' => 'Caloocan',
                        'Malabon' => 'Malabon',
                    ]),
                SelectFilter::make('program')
                    ->options([
                        'BSIT' => 'BSIT',
                        'BSCS' => 'BSCS',
                        'BSIS' => 'BSIS',
                    ]),
                SelectFilter::make('year_level')
                    ->options([
                        '1st Year' => '1st Year',
                        '2nd Year' => '2nd Year',
                        '3rd Year' => '3rd Year',
                        '4th Year' => '4th Year',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
