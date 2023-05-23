<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Parametre as ModelsParametre;
use Filament\Widgets\TableWidget as BaseWidget;

class ParametreTested extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return ModelsParametre::query()->latest();
    }
    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('TemperatureValeur')
                ->label('Temperature Valeur')->suffix("     °C"),
                TextColumn::make('HumidityValeur')
                ->label('Humidity Valeur')->suffix("     %"),
                TextColumn::make('SoilValeur')
                ->label('Soil Valeur')->suffix("     %"),
                TextColumn::make('LightValeur')
                ->label('Light Valeur')->suffix("     Lux"),
        ];
    }

}
