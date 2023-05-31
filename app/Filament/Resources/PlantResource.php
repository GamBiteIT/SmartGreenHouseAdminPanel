<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Plant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlantResource\RelationManagers;
use App\Filament\Resources\PlantResource\RelationManagers\SeasonRelationManager;
use Illuminate\Database\Eloquent\Model;


class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;
    public static function getGloballySearchableAttributes(): array
{
    return ['type', 'name'];
}
public static function getGlobalSearchResultDetails(Model $record): array
{
    return [
        'Name' => $record->name,
        'Type' => $record->type,
    ];
}
// protected static ?string $recordTitleAttribute = 'name';



    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Plant';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->label("Name")->nullable(false),
                    Select::make('type')->label("Type")
                    ->options([
                        'Tomato' => 'Tomato',
                        'Potato' => 'Potato',
                    ])->nullable(false),
                    TextInput::make('duree_de_plontation')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Jours")->nullable(false),
                    TextInput::make('productivity')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG/HA")->nullable(false),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('duree_de_plontation'),
                TextColumn::make('productivity'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(false),
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
