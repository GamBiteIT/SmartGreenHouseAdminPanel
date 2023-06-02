<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use Filament\Widgets\LineChartWidget;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use App\Models\SensorData;

class TemperatureChart extends ApexChartWidget
{
    protected static string $chartId = 'temperatureChart';
    protected static ?string $heading = 'Temperature Chart';
    protected static ?string $pollingInterval = '5s';
    protected static bool $darkMode = true;
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
        $dateEnd = $dateEnd->addDays(1);
        $data = SensorData::whereBetween('created_at', [$dateStart,$dateEnd])->get();
    }
    return [
        'theme' => [
            'mode' => 'dark' //dark
        ],
        'chart' => [
            'type' => 'line',
            'height' => 300,
        ],
        'series' => [
            [
                'name' => 'Temperature Chart',
                'data' => $data->map(fn ($value) => number_format($value->temperature,2))
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
        'colors' => ['#36A2EB'],
        'stroke' => [
            'curve' => 'smooth',
        ],
    ];
}


}
