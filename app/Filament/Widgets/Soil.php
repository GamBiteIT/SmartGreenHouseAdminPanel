<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class Soil extends LineChartWidget
{
    protected static ?string $heading = 'Soil Chart';
    protected static ?string $pollingInterval = '5s';
    protected function getHeading(): string
    {
        return 'Soil Chart';
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
                    'label' => 'Soil',
                    'data' => $data->map(fn ($value) => $value->soil),
                    'borderColor'=> '#c0150c',
                    'backgroundColor'=> '#9BD0F5',


                ],
            ],
            'labels' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
        ];
    }
}
