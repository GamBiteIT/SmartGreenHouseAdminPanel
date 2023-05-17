<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class SoilChart extends LineChartWidget
{
    protected static ?string $heading = 'Soil Chart';
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
        $soil = $data->get('soil');
        $created_at  = $data->get('created_at');
        $soilarray = $soil->pluck('soil');
        $created_atArray = $created_at->pluck('created_at');
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
        }




            return [
                'datasets' => [
                    [
                        'data' => $soilarray,
                        'borderColor'=> '#c0150c',
                        'backgroundColor'=> '#9BD0F5',
                    ],
                ],
                'labels' => $created_atarr,
            ];

    }
}
