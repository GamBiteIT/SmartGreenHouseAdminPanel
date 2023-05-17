<?php

namespace App\Filament\Widgets;

use App\Models\SensorData;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BlogPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'TemperatureChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'DataChart';
    protected function getFormSchema(): array
{
    return [

        DatePicker::make('date_start')
            ->default('2023-01-01'),

        DatePicker::make('date_end')
            ->default('2023-12-31')

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
        $data = SensorData::orderBy('created_at','asc');
        $temp = $data->get('temperature');
        $created_at  = $data->get('created_at');
        $temparray = $temp->pluck('temperature');
        $hmdty = $data->get('humidity');
        $hmdtyarray = $hmdty->pluck('humidity');
        $soil = $data->get('soil');
        $soilarray = $soil->pluck('soil');
        // $light = $data->get('light');
        // $lightarray = $light->pluck('light');
        $created_atArray = $created_at->pluck('created_at');
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
             $temarr[] = number_format($temparray[$i],2);
        }

        return [

            'chart' => [
                'type' => 'line',
                'height' => 500,

            ],
            'series' => [
                [
                    'name' => 'Temperature',
                    'data' => $temarr,
                    'color'=>'#0272ea'
                ],
                  [
                    'name' => 'Humidity',
                    'data' => $hmdtyarray,
                    'color'=>'#ac8d80'
                ],
                [
                    'name' => 'Soil',
                    'data' => $soilarray,
                    'color'=>'#004d17'
                ],
                // [
                //     'name' => 'Light',
                //     'data' => $lightarray,
                //     'color'=>'#ffb10a'
                // ],
            ],
            'xaxis' => [
                'categories' => $created_atarr,
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
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
