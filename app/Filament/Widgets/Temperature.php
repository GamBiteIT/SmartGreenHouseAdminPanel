<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class Temperature extends LineChartWidget
{
    protected static ?string $heading = 'Temperature Chart';
    protected static ?string $pollingInterval = '5s';
    protected function getHeading(): string
    {
        return 'Temperature Chart';
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
                    'label' => 'Temperature',
                    'borderColor'=> '#36A2EB',
                    'data' => $data->map(fn ($value) => $value->temperature),
                    'backgroundColor'=> '#ffb10a',

                ],
            ],
            'labels' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
        ];
    }
}
