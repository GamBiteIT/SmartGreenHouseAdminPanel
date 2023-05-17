<?php

namespace App\Filament\Resources\DevicesResource\Pages;

use App\Filament\Resources\DevicesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDevices extends EditRecord
{
    protected static string $resource = DevicesResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
