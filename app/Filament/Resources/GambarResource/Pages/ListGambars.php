<?php

namespace App\Filament\Resources\GambarResource\Pages;

use App\Filament\Resources\GambarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGambars extends ListRecords
{
    protected static string $resource = GambarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
