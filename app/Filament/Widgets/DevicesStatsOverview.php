<?php

namespace App\Filament\Widgets;

use App\Models\Devices;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DevicesStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';


    protected function getCards(): array
    {
        $fan = Devices::find(1);
    $pump = Devices::find(2);
    $led = Devices::find(3);
    if($fan->works == 0 ){
      $fanstatus = "OFF";
    }else{
        $fanstatus = "ON";
    }
    if($pump->works == 0 ){
        $pumpstatus = "OFF";
      }else{
          $pumpstatus = "ON";
      }
      if($led->works == 0 ){
        $ledstatus = "OFF";
      }else{
          $ledstatus = "ON";
      }
        return [
            Card::make('FAN',$fanstatus),
            Card::make('PUMP',$pumpstatus),
            Card::make('LED',$ledstatus),
        ];
    }
}
