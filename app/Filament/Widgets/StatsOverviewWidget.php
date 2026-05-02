<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Total number of students')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make('Total Users', User::count())
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            Stat::make('Students in Caloocan', Student::where('campus', 'Caloocan')->count())
                ->description('Students in Caloocan campus')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info'),
            Stat::make('Students in Malabon', Student::where('campus', 'Malabon')->count())
                ->description('Students in Malabon campus')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),
        ];
    }
}