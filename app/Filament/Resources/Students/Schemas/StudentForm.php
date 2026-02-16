<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Wizard\Step::make('Campus & Program')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Grid::make(2)->schema([
                                Select::make('campus')
                                    ->options([
                                        'Caloocan' => 'Caloocan',
                                        'Malabon' => 'Malabon',
                                    ])
                                    ->required()
                                    ->native(false),
                                Select::make('program')
                                    ->options([
                                        'BSIT' => 'BSIT',
                                        'BSCS' => 'BSCS',
                                        'BSIS' => 'BSIS',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),
                            Grid::make(4)->schema([
                                Select::make('admit_type')
                                    ->options([
                                        'Freshman' => 'Freshman',
                                        'Transferee' => 'Transferee',
                                    ])
                                    ->required()
                                    ->native(false),
                                Select::make('year_level')
                                    ->options([
                                        '1st Year' => '1st Year',
                                        '2nd Year' => '2nd Year',
                                        '3rd Year' => '3rd Year',
                                        '4th Year' => '4th Year',
                                    ])
                                    ->required()
                                    ->native(false),
                                TextInput::make('school_year')
                                    ->placeholder('e.g. 2025-2026')
                                    ->required(),
                                Select::make('term')
                                    ->options([
                                        '1st Semester' => '1st Semester',
                                        '2nd Semester' => '2nd Semester',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),
                        ]),

                    Wizard\Step::make('Personal Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Student\'s Information')
                                ->description('Please provide your personal details')
                                ->icon('heroicon-o-identification')
                                ->schema([
                                    Grid::make(4)->schema([
                                        TextInput::make('first_name')
                                            ->label('First Name')
                                            ->required(),
                                        TextInput::make('middle_name')
                                            ->label('Middle Name'),
                                        TextInput::make('last_name')
                                            ->label('Last Name')
                                            ->required(),
                                        TextInput::make('suffix')
                                            ->label('Suffix')
                                            ->placeholder('e.g. Jr.'),
                                    ]),
                                    Grid::make(3)->schema([
                                        Select::make('gender')
                                            ->options([
                                                'Male' => 'Male',
                                                'Female' => 'Female',
                                            ])
                                            ->required()
                                            ->native(false),
                                        Select::make('civil_status')
                                            ->options([
                                                'Single' => 'Single',
                                                'Married' => 'Married',
                                                'Widowed' => 'Widowed',
                                                'Separated' => 'Separated',
                                            ])
                                            ->required()
                                            ->native(false),
                                        TextInput::make('citizenship')
                                            ->required(),
                                    ]),
                                    Grid::make(3)->schema([
                                        DatePicker::make('date_of_birth')
                                            ->required()
                                            ->native(false),
                                        TextInput::make('birthplace')
                                            ->required(),
                                        TextInput::make('religion')
                                            ->required(),
                                    ]),
                                ]),

                            Section::make('Current Address')
                                ->description('Your present address')
                                ->icon('heroicon-o-map-pin')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('current_street_no')
                                            ->label('Street # / Unit #')
                                            ->required(),
                                        TextInput::make('current_street')
                                            ->label('Street')
                                            ->required(),
                                        TextInput::make('current_subdivision')
                                            ->label('Subdivision / Village / Bldg.'),
                                    ]),
                                    Grid::make(4)->schema([
                                        TextInput::make('current_barangay')
                                            ->label('Barangay')
                                            ->required(),
                                        TextInput::make('current_city')
                                            ->label('City / Municipality')
                                            ->required(),
                                        TextInput::make('current_province')
                                            ->label('Province'),
                                        TextInput::make('current_zip_code')
                                            ->label('Zip Code'),
                                    ]),
                                ]),

                            Section::make('Permanent Address')
                                ->description('Your permanent address')
                                ->icon('heroicon-o-home')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('permanent_street_no')
                                            ->label('Street # / Unit #')
                                            ->required(),
                                        TextInput::make('permanent_street')
                                            ->label('Street')
                                            ->required(),
                                        TextInput::make('permanent_subdivision')
                                            ->label('Subdivision / Village / Bldg.'),
                                    ]),
                                    Grid::make(4)->schema([
                                        TextInput::make('permanent_barangay')
                                            ->label('Barangay')
                                            ->required(),
                                        TextInput::make('permanent_city')
                                            ->label('City / Municipality')
                                            ->required(),
                                        TextInput::make('permanent_province')
                                            ->label('Province'),
                                        TextInput::make('permanent_zip_code')
                                            ->label('Zip Code'),
                                    ]),
                                ]),

                            Section::make('Contact Details')
                                ->description('How can we reach you?')
                                ->icon('heroicon-o-phone')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('telephone_no')
                                            ->label('Telephone No.')
                                            ->tel(),
                                        TextInput::make('mobile_no')
                                            ->label('Mobile No.')
                                            ->tel()
                                            ->placeholder('09XXXXXXXXX')
                                            ->required(),
                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->email()
                                            ->placeholder('example@domain.com')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                    ]),
                                ]),
                        ]),

                    Wizard\Step::make('Education')
                        ->icon('heroicon-o-building-library')
                        ->schema([
                            Section::make('Current or Last School Attended')
                                ->description('Information about your previous school')
                                ->icon('heroicon-o-building-office')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Select::make('last_school_type')
                                            ->label('School Type')
                                            ->options([
                                                'Public' => 'Public',
                                                'Private' => 'Private',
                                            ])
                                            ->required()
                                            ->native(false),
                                        TextInput::make('last_school_name')
                                            ->label('Name of School')
                                            ->required(),
                                    ]),
                                    TextInput::make('last_school_program')
                                        ->label('Program / Track & Strand / Specialization'),
                                    Grid::make(4)->schema([
                                        DatePicker::make('last_school_date_of_graduation')
                                            ->label('Date of Graduation')
                                            ->native(false),
                                        TextInput::make('last_school_year')
                                            ->label('School Year')
                                            ->required(),
                                        TextInput::make('last_school_year_level')
                                            ->label('Year Level / Grade')
                                            ->required(),
                                        TextInput::make('last_school_term')
                                            ->label('Term'),
                                    ]),
                                ]),
                        ]),

                    Wizard\Step::make('Parents/Guardian')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Tabs::make('Parents/Guardian Information')
                                ->tabs([
                                    Tabs\Tab::make('Father\'s Information')
                                        ->icon('heroicon-o-user')
                                        ->schema([
                                            Grid::make(4)->schema([
                                                TextInput::make('father_first_name')
                                                    ->label('First Name'),
                                                TextInput::make('father_last_name')
                                                    ->label('Last Name'),
                                                TextInput::make('father_middle_initial')
                                                    ->label('Middle Initial'),
                                                TextInput::make('father_suffix')
                                                    ->label('Suffix'),
                                            ]),
                                            Grid::make(3)->schema([
                                                TextInput::make('father_mobile_no')
                                                    ->label('Mobile Number')
                                                    ->tel(),
                                                TextInput::make('father_email')
                                                    ->label('Email')
                                                    ->email(),
                                                TextInput::make('father_occupation')
                                                    ->label('Occupation'),
                                            ]),
                                        ]),
                                    Tabs\Tab::make('Mother\'s Information')
                                        ->icon('heroicon-o-user')
                                        ->schema([
                                            Grid::make(4)->schema([
                                                TextInput::make('mother_first_name')
                                                    ->label('First Name'),
                                                TextInput::make('mother_last_name')
                                                    ->label('Last Name'),
                                                TextInput::make('mother_middle_initial')
                                                    ->label('Middle Initial'),
                                                TextInput::make('mother_suffix')
                                                    ->label('Suffix'),
                                            ]),
                                            Grid::make(3)->schema([
                                                TextInput::make('mother_mobile_no')
                                                    ->label('Mobile Number')
                                                    ->tel(),
                                                TextInput::make('mother_email')
                                                    ->label('Email')
                                                    ->email(),
                                                TextInput::make('mother_occupation')
                                                    ->label('Occupation'),
                                            ]),
                                        ]),
                                    Tabs\Tab::make('Guardian\'s Information')
                                        ->icon('heroicon-o-user-group')
                                        ->schema([
                                            Grid::make(4)->schema([
                                                TextInput::make('guardian_first_name')
                                                    ->label('First Name'),
                                                TextInput::make('guardian_last_name')
                                                    ->label('Last Name'),
                                                TextInput::make('guardian_middle_initial')
                                                    ->label('Middle Initial'),
                                                TextInput::make('guardian_suffix')
                                                    ->label('Suffix'),
                                            ]),
                                            Grid::make(4)->schema([
                                                TextInput::make('guardian_mobile_no')
                                                    ->label('Mobile Number')
                                                    ->tel(),
                                                TextInput::make('guardian_email')
                                                    ->label('Email')
                                                    ->email(),
                                                TextInput::make('guardian_occupation')
                                                    ->label('Occupation'),
                                                TextInput::make('guardian_relationship')
                                                    ->label('Relationship'),
                                            ]),
                                        ]),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
