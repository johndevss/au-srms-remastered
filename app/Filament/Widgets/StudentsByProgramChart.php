<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsByProgramChart extends ChartWidget
{
    protected ?string $heading = 'Students by Program';

    protected function getData(): array
    {
        $data = Student::select('program', DB::raw('count(*) as count'))
            ->groupBy('program')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->pluck('program')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}