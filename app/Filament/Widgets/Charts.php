<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Kenepa\MultiWidget\MultiWidget;
use App\Filament\Widgets\TemperatureChartV2;

class Charts extends MultiWidget
{
    public array $widgets = [
    //    BlogPostsChart::class
          TemperatureChart::class,
        // TemperatureChartV2::class,

      HumidityChart::class,
      SoilChart::class,
      LightChart::class
    ];
}
