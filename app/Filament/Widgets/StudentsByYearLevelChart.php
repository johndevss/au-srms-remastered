<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsByYearLevelChart extends ChartWidget
{
    protected ?string $heading = 'Students by Year Level';

    protected function getData(): array
    {
        $data = Student::select('year_level', DB::raw('count(*) as count'))
            ->groupBy('year_level')
            ->orderBy('year_level')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->pluck('year_level')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}