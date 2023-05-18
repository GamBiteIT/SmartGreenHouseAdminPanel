<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Kenepa\MultiWidget\MultiWidget;

class Charts extends MultiWidget
{
    public array $widgets = [
    //    BlogPostsChart::class
          TemperatureChart::class,

      HumidityChart::class,
      SoilChart::class,
      LightChart::class
    ];
}
