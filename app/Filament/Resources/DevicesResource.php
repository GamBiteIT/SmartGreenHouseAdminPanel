<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Devices;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\DevicesResource\Pages;
use App\Filament\Resources\DevicesResource\RelationManagers;
use App\Filament\Widgets\DevicesStatsOverview;
use Filament\Tables\Columns\BooleanColumn;

class DevicesResource extends Resource
{
    protected static ?string $model = Devices::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Devices';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card::make()->schema([
                //     TextInput::make("name")->maxLength(100)->nullable(false),
                //     Select::make('works')->options([
                //         false=>"OFF",
                //         true=>"ON",
                //     ])->label("ON/OFF")->nullable(false)
                // ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                BooleanColumn::make('fan')->label("FAN"),
                BooleanColumn::make('pump')->label("PUMP"),
                BooleanColumn::make('led')->label("LED"),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('fan')->label("FAN")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('pump')->label("PUMP")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('led')->label("LED")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ])
            ])
            ->actions([
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DevicesStatsOverview::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevices::route('/create'),
        ];
    }
}
