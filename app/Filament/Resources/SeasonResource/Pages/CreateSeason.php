<?php

namespace App\Filament\Resources\SeasonResource\Pages;

use App\Filament\Resources\SeasonResource;
use App\Models\Observation;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeason extends CreateRecord
{
    protected static string $resource = SeasonResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
protected function getSavedNotificationTitle(): ?string
{
    return 'Season created';
}
protected function afterCreate(): void
{
    $season = $this->record;
    Observation::create([
        'season_id'=>$season->id
    ]);

}
}
