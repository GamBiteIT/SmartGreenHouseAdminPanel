<?php

namespace App\Filament\Resources\ObservationResource\Widgets;

use App\Models\Season;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class PlantParametres extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        $season = Season::latest()->first();
        $plant = $season->plant()->get();
        return $plant;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('duree_floration'),
        ];
    }
}
