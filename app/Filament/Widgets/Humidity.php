<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class Humidity extends LineChartWidget
{
    protected static ?string $heading = 'Humidity Chart';
    protected static ?string $pollingInterval = '5s';
    protected function getHeading(): string
    {
        return 'Humidity Chart';
    }
    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = SensorData::all();
        return [
            'datasets' => [
                [
                    'label' => 'Humidity',

                    'data' => $data->map(fn ($value) => $value->humidity),
                    'borderColor'=> '#75990B',
                    'backgroundColor'=> '#990E0B',


                ],
            ],
            'labels' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
        ];
    }
}
