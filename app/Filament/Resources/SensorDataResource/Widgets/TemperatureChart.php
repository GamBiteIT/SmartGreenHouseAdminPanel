<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use Carbon\Carbon;
use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TemperatureChart extends ApexChartWidget
{
    protected static string $chartId = 'temperatureChart';
    protected static ?string $heading = 'Temperature Chart';
    protected static ?int $contentHeight = 500; //px
    protected static ?int $contentWeight = 600; //px

    public static function canView(): bool
    {
        return false;
    }
    // protected static ?string $pollingInterval = '5s';
    protected static bool $darkMode = true;
    protected function getFormSchema(): array
{
    return [
        DatePicker::make('date_start'),
        DatePicker::make('date_end')
    ];
}

protected static bool $deferLoading = true;
protected function getOptions(): array
{
    if (!$this->readyToLoad) {
        return [];
    }

    //slow query
    sleep(2);
    $dateStart = $this->filterFormData['date_start'];
    $dateEnd = $this->filterFormData['date_end'];
    $datest = '';
    $dateen = '';
    if($dateStart != null){
        $datest = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart);
        $datest = $datest->toDateString();
    }
    if($dateEnd != null){
        $dateen = Carbon::createFromFormat('Y-m-d H:i:s', $dateEnd);
        $dateen = $dateen->addDay(1);
        $dateen = $dateen->toDateString();
    }

    $query = SensorData::query();

    if ($dateStart !== null && $dateEnd !== null) {
        $query->whereBetween('created_at', [$datest, $dateen]);
    } elseif ($dateStart !== null) {
        $query->whereDate('created_at', '>=', $datest);
    } elseif ($dateEnd !== null) {
        $query->whereDate('created_at', '<=', $dateen);
    }

    $data = $query->get();







    return [
        'theme' => [
            'mode' => 'dark' //dark
        ],
        'chart' => [
            'type' => 'line',
            'height' => 500,
            'weight'=>500,
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
