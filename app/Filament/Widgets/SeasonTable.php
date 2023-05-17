<?php

namespace App\Filament\Widgets;

use App\Models\Season;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class SeasonTable extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Season::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Name'),
            TextColumn::make('plant')->label('Plant'),
            TextColumn::make('duree')->label('Durée')->suffix("    Jours"),
            TextColumn::make('4season')->label('Season')
        ];
    }
}
