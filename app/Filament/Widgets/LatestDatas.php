<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\SensorData;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestData extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    protected function getTableQuery(): Builder
    {
        return SensorData::query()->latest();
    }
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('temperature')
                ->label('Temperature'),
                TextColumn::make('humidity')
                ->label('Humidity'),
                TextColumn::make('soil')
                ->label('Soil'),
                TextColumn::make('light')
                ->label('Light'),
        ];
    }

}
