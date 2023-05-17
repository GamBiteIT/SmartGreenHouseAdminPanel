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
        $created_atArray = $created_at->pluck('created_at');
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
             $temarr[] = number_format($temparray[$i],2);
        }

        return [

            'chart' => [
                'type' => 'line',
                'height' => 500,
                'weight'=>2000
            ],
            'series' => [
                [
                    'name' => 'Temperature',
                    'data' => $temarr,
                ],
                  [
                    'name' => 'Humidity',
                    'data' => $hmdtyarray,
                    'color'=>'#501635'
                ],
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
            'colors' => ['#c0150c'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
