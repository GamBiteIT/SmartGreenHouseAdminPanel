<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class HumidityChart extends LineChartWidget
{
    protected static ?string $heading = 'Humidity Chart';
    protected static ?string $pollingInterval = '5s';
    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = SensorData::orderBy('created_at','asc');
        $hmdty = $data->get('humidity');
        $created_at  = $data->get('created_at');
        $hmdtyarray = $hmdty->pluck('humidity');
        $created_atArray = $created_at->pluck('created_at');




            return [
                'datasets' => [
                    [
                        'data' => $hmdtyarray,
                        'borderColor'=> '#36A2EB',
                        'backgroundColor'=> '#9BD0F5',
                    ],
                ],
                'labels' => $created_atArray,
            ];

    }
}
