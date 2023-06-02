<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use App\Models\SensorData;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class Light extends ApexChartWidget
{
    protected static string $chartId = 'lightChart';
    protected static ?string $heading = 'Light Chart';
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
                'name' => 'Light Chart',
                'data' => $data->map(fn ($value) => $value->light)
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
        'colors' => ['#eaeaea'],
        'stroke' => [
            'curve' => 'smooth',
        ],
    ];
}




}
