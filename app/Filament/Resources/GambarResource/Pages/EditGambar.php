<?php

namespace App\Filament\Resources\GambarResource\Pages;

use Filament\Actions;
use App\Models\Gambar;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\GambarResource;

class EditGambar extends EditRecord
{
    protected static string $resource = GambarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pastikan image_desc tetap sebagai string saat update
        if (isset($data['image_desc']) && is_array($data['image_desc'])) {
            $data['image_desc'] = implode(',', $data['image_desc']);
        }

        return $data;
    }
}
