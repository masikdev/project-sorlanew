<?php

namespace App\Filament\Resources\GambarResource\Pages;

use Filament\Actions;
use App\Models\Gambar;
use App\Filament\Resources\GambarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGambar extends CreateRecord
{
    protected static string $resource = GambarResource::class;

    protected function handleRecordCreation(array $data): Gambar
    {
        // Simpan gambar pertama untuk dikembalikan
        $firstRecord = null;

        // Loop untuk menyimpan data multiple images
        foreach ($data['image_desc'] as $imageName) {
            // Simpan path file yang sudah diupload
            $path = $imageName; // Sesuaikan dengan lokasi file yang sesuai

            $newRecord = Gambar::create([
                'id_project' => $data['id_project'],  // Foreign key
                'image_desc' => $path,               // Path file gambar
                'image_name' => $data['image_name']   // Nama gambar (gunakan sesuai kebutuhan)
            ]);

            // Simpan record pertama untuk dikembalikan
            if (!$firstRecord) {
                $firstRecord = $newRecord;
            }
        }

        return $firstRecord;
    }

    
}
