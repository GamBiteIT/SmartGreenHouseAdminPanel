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
                ->label('Temperature Valeur'),
                TextColumn::make('HumidityValeur')
                ->label('Humidity Valeur'),
                TextColumn::make('SoilValeur')
                ->label('Soil Valeur'),
                TextColumn::make('LightValeur')
                ->label('Light Valeur'),
        ];
    }

}
