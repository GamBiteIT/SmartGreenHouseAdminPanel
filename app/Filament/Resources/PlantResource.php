<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Plant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlantResource\RelationManagers;
use App\Filament\Resources\PlantResource\RelationManagers\SeasonRelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;


    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Plant';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->label("Name")->nullable(false),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SeasonRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlants::route('/'),
            'create' => Pages\CreatePlant::route('/create'),
            'edit' => Pages\EditPlant::route('/{record}/edit'),
        ];
    }
}
