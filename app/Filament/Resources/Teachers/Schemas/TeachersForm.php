<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeachersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Employment Information')
                    ->columns(2)
                    ->schema([
                        Select::make('campus')
                            ->options(['Caloocan' => 'Caloocan', 'Malabon' => 'Malabon'])
                            ->required(),
                        Select::make('department')
                            ->options([
                                'Computer Studies'        => 'Computer Studies',
                                'Engineering'             => 'Engineering',
                                'Education'               => 'Education',
                                'Business Administration' => 'Business Administration',
                                'Arts and Sciences'       => 'Arts and Sciences',
                            ])
                            ->required(),
                        Select::make('position')
                            ->options([
                                'Instructor'          => 'Instructor',
                                'Assistant Professor' => 'Assistant Professor',
                                'Associate Professor' => 'Associate Professor',
                                'Professor'           => 'Professor',
                            ])
                            ->required(),
                        Select::make('employment_type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                            ])
                            ->required(),
                        Select::make('employment_status')
                            ->options([
                                'Active'   => 'Active',
                                'Inactive' => 'Inactive',
                                'Resigned' => 'Resigned',
                                'Retired'  => 'Retired',
                            ])
                            ->required(),
                        DatePicker::make('date_hired')->required(),
                    ]),

                Section::make('Personal Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('first_name')->required(),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name')->required(),
                        TextInput::make('suffix'),
                        Select::make('gender')
                            ->options(['Male' => 'Male', 'Female' => 'Female'])
                            ->required(),
                        Select::make('civil_status')
                            ->options(['Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed'])
                            ->required(),
                        TextInput::make('citizenship')->required(),
                        DatePicker::make('date_of_birth')->required(),
                        TextInput::make('birthplace')->required(),
                        TextInput::make('religion')->required(),
                    ]),

                Section::make('Address')
                    ->columns(2)
                    ->schema([
                        TextInput::make('street_no'),
                        TextInput::make('street')->required(),
                        TextInput::make('subdivision'),
                        TextInput::make('barangay')->required(),
                        TextInput::make('city')->required(),
                        TextInput::make('province'),
                        TextInput::make('zip_code'),
                    ]),

                Section::make('Contact Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('telephone_no'),
                        TextInput::make('mobile_no')->required(),
                        TextInput::make('email')->email()->required(),
                    ]),

                Section::make('Educational Background')
                    ->columns(2)
                    ->schema([
                        Select::make('highest_educational_attainment')
                            ->options([
                                'Bachelor'  => 'Bachelor',
                                'Master'    => 'Master',
                                'Doctorate' => 'Doctorate',
                            ])
                            ->required(),
                        TextInput::make('degree')->required(),
                        TextInput::make('school'),
                        TextInput::make('year_graduated'),
                    ]),
            ]);
    }
}