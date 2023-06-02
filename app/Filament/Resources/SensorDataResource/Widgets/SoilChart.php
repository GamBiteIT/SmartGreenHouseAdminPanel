<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use App\Models\SensorData;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class SoilChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'soilChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Soil Chart';
    protected static ?string $pollingInterval = '5s';
    protected function getFormSchema(): array
{
    return [
        DatePicker::make('date_start'),
        DatePicker::make('date_end')
    ];
}

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
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
                    'name' => 'Soil Chart',
                    'data' => $data->map(fn ($value) => $value->soil),
                    'borderColor'=> '#c0150c',
                    'backgroundColor'=> '#9BD0F5',

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
            'colors' => ['#9BD0F5'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
