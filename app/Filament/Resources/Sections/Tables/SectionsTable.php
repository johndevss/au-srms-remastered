<?php

namespace App\Filament\Resources\Sections\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class SectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_code')
                    ->label('Section Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('campus')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('program')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_level')
                    ->label('Year Level')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('term')
                    ->searchable(),
                Tables\Columns\TextColumn::make('school_year')
                    ->label('School Year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('teachers_count')
                    ->label('Teachers')
                    ->counts('teachers'),
                Tables\Columns\TextColumn::make('students_count')
                    ->label('Students')
                    ->counts('students'),
            ]);
    }
}