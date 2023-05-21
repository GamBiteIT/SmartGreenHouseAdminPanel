<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class TemperatureChart extends LineChartWidget
{
    protected static ?string $pollingInterval = '5s';
    protected static ?string $maxHeight = '300px';
    protected static ?string $heading = 'Chart';
    protected function getHeading(): string
    {
        return 'Temperature Chart';
    }
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
        for ($i=0; $i < count($created_atArray); $i++) {
            $created_atarr[] = \Carbon\Carbon::parse($created_atArray[$i])->format('M d, Y H:i:s');
            $temarr[] = number_format($temparray[$i],2);
        }





            return [
                'datasets' => [
                    [
                        'data' => $temarr,
                        'borderColor'=> '#36A2EB',
                        'backgroundColor'=> '#ffb10a',
                    ],
                ],
                'labels' => $created_atarr,
            ];
    }
}
