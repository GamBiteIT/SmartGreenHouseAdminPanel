<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Season;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SeasonResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SeasonResource\RelationManagers;
use App\Filament\Resources\SeasonResource\RelationManagers\ParametresRelationManager;

class SeasonResource extends Resource
{
    protected static ?string $model = Season::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-s-document-text';
    protected static ?string $navigationGroup = 'Season';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->label("Name"),
                    TextInput::make("plant")->required(),
                    TextInput::make("duree")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(30)->maxValue(90)->integer())->suffix("   Jours")->label("Durée"),
                    Select::make('4season')->label("Les quatre saisons")
    ->options([
        'printemps' => 'Printemps',
        'été' => 'Été',
        'automne' => 'Automne',
        'hiver' => 'Hiver',
    ]),
    TextInput::make('productivity')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Productivity")->placeholder("Please fill this field after the season"),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID"),
                TextColumn::make('name')->label("Name")->sortable()->searchable(),
                TextColumn::make('plant')->label("Plant"),
                TextColumn::make('duree')->label("Duree")->suffix("    Jours"),
                TextColumn::make('4season')->label("Les quatre saisons"),
                TextColumn::make('productivity')->label("productivity")->suffix("     KG"),
                TextColumn::make('created_at')->dateTime()

            ])
            ->filters([
                SelectFilter::make('4season')->label("Les quatre saisons")
    ->options([
        'printemps' => 'Printemps',
        'été' => 'Été',
        'automne' => 'Automne',
        'hiver' => 'Hiver',
    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ParametresRelationManager::class,
            RelationManagers\SensordataRelationManager::class,
            RelationManagers\ExtraRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeasons::route('/'),
            'create' => Pages\CreateSeason::route('/create'),
            'edit' => Pages\EditSeason::route('/{record}/edit'),
        ];
    }
}
