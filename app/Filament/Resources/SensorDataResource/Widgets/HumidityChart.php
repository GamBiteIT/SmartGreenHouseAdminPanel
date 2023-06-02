<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use Filament\Widgets\LineChartWidget;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use App\Models\SensorData;

class HumidityChart extends ApexChartWidget
{
    protected static string $chartId = 'humidityChart';
    protected static ?string $heading = 'Humidity Chart';

    protected static ?string $pollingInterval = '5s';
    protected function getFormSchema(): array
{
    return [
        DatePicker::make('date_start'),
        DatePicker::make('date_end')
    ];
}
protected function getOptions(): array
{
    $dateStart = $this->filterFormData['date_start'];
    $dateEnd = $this->filterFormData['date_end'];

    if($dateStart == null OR $dateEnd == null){
        $data = SensorData::all();
         }else{
             $data = SensorData::whereBetween('created_at', [$dateStart,$dateEnd])->get();
         }
    return [
        'chart' => [
            'type' => 'line',
            'height' => 300,
        ],
        'series' => [
            [
                'name' => 'Humidity Chart',
                'data' => $data->map(fn ($value) => $value->humidity),
            ],
        ],
        'xaxis' => [
            'categories' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
            'labels' => [
                'style' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ],
        'yaxis' => [
            'labels' => [
                'style' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ],
        'colors' => ['#990E0B'],
        'stroke' => [
            'curve' => 'smooth',
        ],
    ];
}

}
