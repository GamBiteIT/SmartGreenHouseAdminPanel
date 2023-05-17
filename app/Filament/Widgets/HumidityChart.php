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
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
        }




            return [
                'datasets' => [
                    [
                        'data' => $hmdtyarray,
                        'borderColor'=> '#75990B',
                        'backgroundColor'=> '#990E0B',
                    ],
                ],
                'labels' => $created_atarr,
            ];

    }
}
