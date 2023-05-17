<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class TemperatureChart extends LineChartWidget
{
    protected static ?string $pollingInterval = '5s';
    protected static ?string $maxHeight = '300px';
    protected static ?string $heading = 'Chart';
    protected function getHeading(): string
    {
        return 'Temperature';
    }
//     protected function getFilters(): ?array
// {
//     return [
//         'today' => 'Today',
//         'week' => 'Last week',
//         'month' => 'Last month',
//         'year' => 'This year',
//     ];
// }
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
        $temp = $data->get('temperature');
        $created_at  = $data->get('created_at');
        $temparray = $temp->pluck('temperature');
        $created_atArray = $created_at->pluck('created_at');




            return [
                'datasets' => [
                    [
                        'data' => $temparray,
                        'borderColor'=> '#36A2EB',
                        'backgroundColor'=> '#9BD0F5',
                    ],
                ],
                'labels' => $created_atArray,
            ];

    }
}
