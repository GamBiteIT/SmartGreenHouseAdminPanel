<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SensorDataResource\Pages;
use App\Filament\Resources\SensorDataResource\RelationManagers;
use App\Filament\Widgets\DataStatsOverview;
use App\Models\SensorData;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SensorDataResource extends Resource
{
    protected static ?string $model = SensorData::class;

    protected static ?string $navigationIcon = 'heroicon-o-database';
    protected static ?string $navigationGroup = 'Data';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season_id')->label("Season ID"),
                TextColumn::make('temperature')->suffix("   °C")->sortable(),
                TextColumn::make('humidity')->suffix("   %")->sortable(),
                TextColumn::make('soil')->suffix("   %")->sortable(),
                TextColumn::make('light')->suffix("    lux")->sortable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSensorData::route('/'),

        ];
    }
}
