<?php

namespace App\Filament\Widgets;

use App\Models\Parametre;
use App\Models\SensorData;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DataStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    protected function getCards(): array
    {
        $data = SensorData::latest()->first();
        $param = Parametre::latest()->first();
        if($data==null){
            $temperature = 0.0;
            $humidity = 0.0;
            $soil=0.0;
            $light=0.0;
         }else{
            $temperature = number_format($data->temperature,1).'   °C';
            $humidity = intval($data->humidity).'   %';
            $soil = intval($data->soil).'   %';
            $light = intval($data->light).'   Lux';
         }
        if($param == null){
            $situation = "Cool";
            $colorTemp = 'success';
            $situationH = "Bien";
            $colorH = 'success';
            $situationS = "Wet";
            $colorS = "success";
            $situationL = "Light";
            $colorL = "success";
 }else{

            if($param->TemperatureValeur>$data->temperature){
                $situation = "Cool";
                $colorTemp = 'success';
            }else{
                $situation = "Hot";
                $colorTemp = "danger";
            }
            if($param->HumidityValeur>$data->humidity){
                $situationH = "Bien";
                $colorH = 'success';
            }else{
                $situationH = "Pas Bien";
                $colorH = "danger";
            }
            if($param->SoilValeur>$data->soil){

                $situationS = "Dry";
                $colorS = "danger";
            }else{
                $situationS = "Wet";
                $colorS = 'success';
            }
            if($param->LightValeur>$data->light){
                $situationL = "Dark";
                $colorL = 'danger';
            }else{
                $situationL = "Light";
                $colorL = "success";
            }}





        return [
             Card::make('Temperature',$temperature) ->description($situation)->color($colorTemp),
             Card::make('Humidity',$humidity)->description($situationH)->color($colorH),
             Card::make('Soil',$soil)->description($situationS)->color($colorS),
             Card::make('Light',$light)->description($situationL)->color($colorL),
        ];
    }

}
