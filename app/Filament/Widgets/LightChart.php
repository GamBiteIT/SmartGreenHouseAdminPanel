<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class LightChart extends LineChartWidget
{
    protected static ?string $heading = 'Light Chart';
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
        $light = $data->get('light');
        $created_at  = $data->get('created_at');
        $lightarray = $light->pluck('light');
        $created_atArray = $created_at->pluck('created_at');
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
        }




            return [
                'datasets' => [
                    [
                        'data' => $lightarray,
                        'borderColor'=> '#004d17',
                        'backgroundColor'=> '#eaeaea',
                    ],
                ],
                'labels' => $created_atarr,
            ];

    }
}
