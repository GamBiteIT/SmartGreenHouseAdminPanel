<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Kenepa\MultiWidget\MultiWidget;
use App\Filament\Widgets\TemperatureChart;


class Charts extends MultiWidget
{
    public array $widgets = [
   TemperatureChart::class,

      HumidityChart::class,
      SoilChart::class,
      LightChart::class
    ];
}
